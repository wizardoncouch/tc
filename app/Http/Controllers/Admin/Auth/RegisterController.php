<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Requests\Admin\Auth\RegisterRequest;
use App\Http\Requests\Admin\Auth\DenyUserRequest;
use App\Http\Controllers\Admin\BaseController;
use App\Admin\User;
use Exception;

class RegisterController extends BaseController
{
    #class constructor
    public function __construct(){
        #initialize variables from the parent class
        $this->init();
    }
    
    public function show(){
    	try{
    		# data for display;
            $this->data['name'] = 'register';
            $this->data['title'] = 'Register';
    		#call the blade template
	        return view('admin.auth.register', $this->data);
	        
    	}catch(Exception $e){
    		# process exception
    		$this->response(__method__, $e->getMessage(), 500);
    	}
    }


    public function store(RegisterRequest $request){
        try{
            $email = $request->get('email');
            $name = $request->get('name');

            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = str_random(32);
            $user->code = 'verify';
            $user->active = false;
            $user->save();

            $this->response(__method__, $user);
            return redirect()->route('admin.register.show')->with('status', 'Your request has been submitted. You will recieve an email when you get approved.')->withInput();

        }catch(Exception $e){
            $this->response(__method__, $e->getMessage(), 500);
        }
    }

    public function deny(DenyUserRequest $request){
    	try{
    		$id = $request->get('id');
    		$user = User::whereId($id)->first();
    		$user->code = 'denied';
    		$user->active = false;
    		$user->save();

            $this->response(__method__, $user);

            return redirect()->route('admin.dashboard.index');
        }catch(Exception $e){
            $this->response(__method__, $e->getMessage(), 500);
        }
    }
}
