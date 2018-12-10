<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;

class TemplateController extends BaseController
{
    #class constructor
    public function __construct()
    {
        #initialize variables from the parent class
        $this->init();
    }

    public function index(Request $request)
    {
        try {

        } catch (Exception $e) {
            $this->response(__method__, $e->getMessage(), 500);
        }
    }
}
