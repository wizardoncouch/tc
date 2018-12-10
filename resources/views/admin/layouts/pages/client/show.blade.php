@extends('admin.layouts.pages.logged')
@section('page')
    <div class="row">
        <div class="col-xl-7 col-xs-12">
            <div class="cardbox">
                <div class="cardbox-body">
                    <form class="form">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">URL:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="name" value="https://{{$client->slug}}.teamconsole.io">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="name" value="{{$client->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="email" value="{{$client->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Database name:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="email" value="{{$client->db_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Created At:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="email" value="{{$client->created_at}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Activated At:</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="email" value="{{$client->activated_at}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Active:</label>
                            <div class="col-sm-10">
                                <i class="fas fa-check {{$client->active ? 'text-primary': 'text-light'}}"></i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10 clearfix">
                                <a class="btn btn-primary btn-sm" href="javascript:void(0);">
                                    <i class="fas fa-check-circle"></i> Health Check
                                </a>
                                <a class="btn btn-warning btn-sm float-right" href="javascript:void(0);">
                                    <i class="fas fa-minus-circle"></i> Deactivate
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END panel-->
        </div>
    </div>

@endsection
