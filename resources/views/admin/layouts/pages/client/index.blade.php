@extends('admin.layouts.pages.logged')
@section('page')
    <div class="row">
        <div class="col-xl-7 col-xs-12">
            <div class="cardbox">
                <div class="cardbox-heading clearfix">
                    <!--<strong>Clients</strong>-->
                    <a class="btn btn-info btn-sm ml-2 float-right" href="{{ route('admin.client.create') }}">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Url</th>
                        <th>Active</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($clients) > 0)
                        @foreach($clients as $client)
                            <tr>
                                <td class="pl-3">
                                    <a href="{{route('admin.client.show', $client->id)}}">
                                        {{$client->name}}
                                    </a>
                                </td>
                                <td class="pl-3">{{$client->email}}</td>
                                <td class="pl-3"><code>https://{{$client->slug}}.teamconsole.io</code></td>
                                <td><i class="fas fa-check ml-3 {{$client->active ? 'text-primary': 'text-light'}}"></i></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">No results found.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xl-5 col-xs-12">
            @if(count($client_requests) > 0)

                <div class="cardbox bg-secondary text-light">
                    <div class="cardbox-heading"><strong>Requesting Access</strong></div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($client_requests as $client)
                            <tr>
                                <td class="pl-3">{{$client->name}}</td>
                                <td class="pl-3">{{$client->email}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
