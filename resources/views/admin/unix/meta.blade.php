{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.admin')
@include('partials/admin.unix.nav', ['activeTab' => 'meta'])

@section('title')
    Unix Meta
@endsection

@section('content-header')
    <h1>Unix<small>Configure your meta</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.unix') }}">Unix</a></li>
        <li class="active">Meta</li>
    </ol>
@endsection

@section('content')
    @yield('unix::nav')
    <div class="alert alert-info">
        When sending a link in Discord or other places this is the card displayed, the keywords are also used by Search
        Engines such as Google.
    </div>

    <div class="row">
        <form action="{{ route('admin.unix.setting') }}" method="POST">
            @csrf
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Meta Configuration</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Title</label>
                                <div>
                                    <input type="text" class="form-control" name="metatitle"
                                        value="{{ $setting_data['metatitle'] ?? config('app.name', 'Pterodactyl') }}"
                                        required />
                                    <p class="text-muted">
                                        <small>
                                            This is the title of the Meta card.
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Image URL</label>
                                <div>
                                    <input type="text" class="form-control" name="metaimg"
                                        value="{{ $setting_data['metaimg'] ?? '/assets/svgs/pterodactyl.svg' }}" required />
                                    <p class="text-muted">
                                        <small>
                                            This is the URL of the Image, make sure it ends with .png, jpeg etc
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Theme Color</label>
                                <div>
                                    <input class="form-control" name="metacolor"
                                        value="{{ $setting_data['metacolor'] ?? '#0967d3' }}" required />
                                    <p class="text-muted">
                                        <small>
                                            This is the side-color of the meta card.
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Description</label>
                                <div>
                                    <textarea type="text" class="form-control" name="metadesc" required style="resize: vertical;">{{ $setting_data['metadesc'] ?? 'Manage your server with an easy-to-use Panel' }}</textarea>
                                    <p class="text-muted">
                                        <small>
                                            This is the description of the meta card.
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-sm btn-primary pull-right">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
