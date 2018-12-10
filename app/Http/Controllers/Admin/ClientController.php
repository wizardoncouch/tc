<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Client;
use App\Http\Requests\Admin\CreateClientRequest;
use App\Jobs\Admin\CreateClient;
use Illuminate\Http\Request;
use Exception;

class ClientController extends BaseController
{
    #class constructor
    public function __construct()
    {
        #initialize variables from the parent class
        $this->init();
    }

    public function index()
    {
        try {
            $this->data['name'] = 'clients';
            $this->data['title'] = 'Clients';
            $this->data['client_requests'] = Client::whereActive(false)->whereActivatedAt(null)->get();
            $this->data['clients'] = Client::all();

            #call the blade template
            return view('admin.layouts.pages.client.index', $this->data);

        } catch (Exception $e) {
            return $this->response(__method__, $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $client = Client::whereId($id)->first();

            $this->data['name'] = 'client_show';
            $this->data['breadcrumbs'] = [
                ['link' => route('admin.client.index'), 'name' => 'Clients'],
                $client->name
            ];

            $this->data['client'] = $client;

            #call the blade template
            return view('admin.layouts.pages.client.show', $this->data);

        } catch (Exception $e) {
            return $this->response(__method__, $e->getMessage(), 500);
        }
    }

    public function create()
    {
        try {
            $this->data['name'] = 'client_create';
            $this->data['breadcrumbs'] = [
                ['link' => route('admin.client.index'), 'name' => 'Clients'],
                'Create'
            ];

            #call the blade template
            return view('admin.layouts.pages.client.create', $this->data);

        } catch (Exception $e) {
            return $this->response(__method__, $e->getMessage(), 500);
        }
    }

    public function store(CreateClientRequest $request)
    {
        try {
            $name = $request->get('name');
            $email = $request->get('email');
            $slug = $request->get('slug');

            $client = new Client();
            $client->user_id = $client->id;
            $client->name = $name;
            $client->email = $email;
            $client->slug = $slug;
            $client->db_name = 'tc_'.strtolower($slug);
            $client->token = str_random(32);
            $client->active = true;
            $client->activated_at = date('Y-m-d H:i:s');
            $client->save();
            CreateClient::dispatch($client);

            return redirect()->route('admin.client.index')->with('status', 'Client added.');

        } catch (Exception $e) {
            return $this->response(__method__, $e->getMessage(), 500);
        }

    }

}
