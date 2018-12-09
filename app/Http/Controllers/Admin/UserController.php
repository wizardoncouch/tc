<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Admin\User;
use App\Admin\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class UserController extends BaseController
{
    #class constructor
    public function __construct(){
        #initialize variables from the parent class
        $this->init();
    }

    public function index(){
    	try{
            $this->data['name'] = 'user'; 
            $this->data['title'] = 'Users'; 

            $this->data['user_requests'] = User::whereActive(false)->whereCode('verify')->get();
            $this->data['users'] = User::where('code','!=','verify')
                ->where('code','!=','denied')
                ->where('activated_at','>','')
                ->with(['roles'])
                ->get();
            #call the blade template
            return view('admin.layouts.pages.user.index', $this->data);

    	}catch(Exception $e){
    		return $this->response(__method__, $e->getMessage(), 500);
    	}
    }

    public function show($id){
        try{
            $user = User::whereId($id)->with('roles')->first();

            if($user->code == 'verify' && $user->active == false){
                return redirect()->route('admin.user.edit', ['id' => $user->id, 'mode' => 'approve']);
            }

            $this->data['name'] = 'user_edit'; 
            $this->data['breadcrumbs'] = [
                ['link' => route('admin.user.index'), 'name' => 'Users'],
                $user->name
            ];
            
            $this->data['user'] = $user;

            #call the blade template
            return view('admin.layouts.pages.user.show', $this->data);

        }catch(Exception $e){
            return $this->response(__method__, $e->getMessage(), 500);
        }
    }

    public function create(){
        try{
            $this->data['name'] = 'user_create'; 
            $this->data['breadcrumbs'] = [
                ['link' => route('admin.user.index'), 'name' => 'Users'],
                'Create'
            ];

            $this->data['roles'] = Role::all();

            #call the blade template
            return view('admin.layouts.pages.user.create', $this->data);

        }catch(Exception $e){
            return $this->response(__method__, $e->getMessage(), 500);
        }
    }

    public function store(CreateUserRequest $request){
        try{
            $name = $request->get('name');
            $email = $request->get('email');
            $roles = $request->get('roles');

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = str_random(32);
            $user->code = str_random(6);
            $user->active = true;
            $user->activated_at = date('Y-m-d H:i:s');
            $user->save();
            $user->roles()->attach($roles);

            $this->response(__method__, $user);
            return redirect()->route('admin.user.index')->with('status', 'User added.');

        }catch(Exception $e){
            return $this->response(__method__, $e->getMessage(), 500);
        }

    }

    public function edit(Request $request, $id){
        try{

            $user = User::whereId($id)->with('roles')->first();
            $mode = $request->get('mode');
            if($user->code == 'verify' && $user->active == false && $mode != 'approve'){
                return redirect()->route('admin.user.edit', ['id' => $user->id, 'mode' => 'approve']);
            }

            $this->data['name'] = 'user_edit'; 
            $this->data['breadcrumbs'] = [
                ['link' => route('admin.user.index'), 'name' => 'Users'],
                ['link' => route('admin.user.show', $user->id), 'name' => $user->name],
            ];
            switch($request->get('mode')){
                case 'approve':
                    $this->data['breadcrumbs'][] = 'Approve';
                    break;
                default:
                    $this->data['breadcrumbs'][] = 'Edit';
                    break;
            }
            $this->data['mode'] = $request->get('mode');
            $this->data['user'] = $user;
            $this->data['roles'] = Role::all();

            #call the blade template
            return view('admin.layouts.pages.user.edit', $this->data);

        }catch(Exception $e){
            return $this->response(__method__, $e->getMessage(), 500);
        }
    }

    public function update(UpdateUserRequest $request){
        try{
            $user = User::find($request->get('id'));
            if($request->has('approve')){
                $user->code = str_random(6);
                $user->active = true;
                $user->activated_at = date('Y-m-d H:i:s');
            }else if($request->has('password')){
                $user->password = Hash::make($request->get('password'));
            }else{
                $roles = $request->get('roles');
                $user->name = $request->get('name');
                $user->email = $request->get('email');
                $user->password = str_random(32);
                $user->code = str_random(6);
                if($request->has('active')){
                    $user->active = true;
                }else{
                    $user->active = false;
                }
                $user->activated_at = date('Y-m-d H:i:s');
                $user->roles()->sync($roles);
            }
            $user->save();

            $this->response(__method__, $user);
            return redirect()->route('admin.user.index')->with('status', 'User added.');

        }catch(Exception $e){
            return $this->response(__method__, $e->getMessage(), 500);
        }

    }


}
