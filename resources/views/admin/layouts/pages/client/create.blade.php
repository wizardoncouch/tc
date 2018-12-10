@extends('admin.layouts.pages.logged')
@section('page')
    <div class="row">
        <div class="col-xl-7 col-xs-12">
            <form class="form-validate" id="admin-client-create" name="form" method="POST" action="{{route('admin.client.store')}}" autocomplete="false" novalidate>
                @csrf
                <div class="cardbox">
                    <div class="cardbox-heading">
                        <small class="float-right text-danger">* Required fields</small>
                    </div>
                    <div class="cardbox-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">URL <span class="text-danger float-right">*</span></label>
                            <div class="col-sm-10"> <!--This is for the validation error-->
                                <div class=" input-group">
                                    <input type="text" class="form-control {{ $errors->has('slug') ? ' error' : '' }}" placeholder="slug" name="slug" value="{{old('slug')}}" required autofocus />
                                    <div class="input-group-append">
                                        <span class="input-group-text">.teamconsole.io</span>
                                    </div>
                                </div>
                                @if ($errors->has('slug'))
                                    <label id="slug-error" class="error text-danger text-sm" for="slug">{{ $errors->first('slug') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Organization <span class="text-danger float-right">*</span></label>
                            <div class="col-sm-10">
                                <input class="form-control {{ $errors->has('name') ? ' error' : '' }}" type="text" placeholder="XYZ Solutions Inc." name="name" value="{{old('name')}}" required />
                                @if ($errors->has('name'))
                                    <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email <span class="text-danger float-right">*</span></label>
                            <div class="col-sm-10">
                                <input class="form-control {{ $errors->has('email') ? ' error' : '' }}" type="text" placeholder="email@example.com" name="email" value="{{old('email')}}" required />
                                @if ($errors->has('name'))
                                    <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="cardbox-body">
                        <div class="clearfix">
                            <div class="float-right">
                                <button class="btn btn-info btn-sm" id="admin-client-create-submit-button" type="submit">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END panel-->
            </form>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('js/admin/client.js') }}" defer></script>
@endsection
