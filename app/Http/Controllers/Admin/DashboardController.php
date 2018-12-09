<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Admin\User;
use App\Admin\Client;

class DashboardController extends BaseController
{

    #class constructor
    public function __construct(){
        #initialize variables from the parent class
        $this->init();
    }
	# redirect to login page if not logged in
	# display dashboard
    public function index(){
    	try{
            # data for display;
            $this->data['name'] = 'dashboard';
            $this->data['title'] = 'Dashboard';

            $this->data['user_requests'] = User::whereActive(false)->whereCode('verify')->get();
            $this->data['client_requests'] = Client::whereActive(false)->whereActivatedAt(null)->get();

            #call the blade template
            return view('admin.layouts.pages.dashboard.index', $this->data);

    	}catch(Exception $e){
    		return $this->response(__method__, $e->getMessage(), 500);
    	}
    }
}
