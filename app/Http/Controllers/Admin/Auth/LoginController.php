<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Admin\User;
use Exception;

class LoginController extends BaseController
{
    #class constructor
    public function __construct(){
        #initialize variables from the parent class
        $this->init();
    }

    public function show(){
    	try{
    		# data for display;
            $this->data['name'] = 'login';
            $this->data['title'] = 'Login';
    		#call the blade template
	        return view('admin.auth.login', $this->data);
	        
    	}catch(Exception $e){
    		# process exception
    		$this->response(__method__, $e->getMessage(), 500);
    	}
    }

    public function login(LoginRequest $request){
        try{
            $email = $request->get('email');
            $password = $request->get('password');
            $remember = $request->get('remember');
            $user = User::whereEmail($email)->first();

            #check if active
            if(!$user->active){
                $this->response(__method__, ['inactive' => $user], 422);
                return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Account is inactive']);
            }
            #check if it was deleted
            if(!empty($user->deleted_at)){
                $this->response(__method__, ['deleted' => $user], 422);
                return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Account was deleted']);
            }
            #attempty to authenticate
            if(Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $remember)){
                $this->response(__method__, $user);
                return redirect()->route('admin.dashboard.index');
            }else{
                $this->response(__method__, ['invalid' => $user], 422);
                return back()->withInput($request->only('email', 'remember'))->withErrors(['password' => 'Invalid password']);
            }

        }catch(Exception $e){

            $this->response(__method__, $e->getMessage(), 500);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.show');
    }
}
