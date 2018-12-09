<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller
{
	protected $data;
	
    protected function init(){
        $this->data = [
            'name' => '',
            'title' => '',
            'breadcrumbs' => []
        ];
    }

    protected function response($method, $data, $code = 200){
        switch ($code){
            case 200:
                Log::info(sprintf('%s => ', $method), [$data]);
                break;
            case 500:
                Log::critical(sprintf('%s => ', $method), [$data]);
                abort(500, 'Something went wrong. Inform your system administrator.');
                break;
            default:
                Log::error(sprintf('%s => ', $method), [$data]);
                break;
        }
    }
}
