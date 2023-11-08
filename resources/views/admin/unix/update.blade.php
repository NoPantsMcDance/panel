{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.admin')
@include('partials/admin.unix.nav', ['activeTab' => 'update'])

@section('title')
    Unix
@endsection

@section('content-header')
    <h1>Unix<small>New updates will be visible here.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.unix') }}">Unix</a></li>
        <li class="active">Update</li>
    </ol>
@endsection

@section('content')
    @yield('unix::nav')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border" style="display: flex;align-items: center;">
                    <h3 class="box-title">Currently running version {{ config('unix.version') }} of the
                        {{ config('unix.name') }} template.</h3> <span class="label label-success"
                        style="margin-left: 5px;font-size: 12px;@if ($check == 'Inactive') background-color: #d64242 !important @endif">{{ $check }}</span>
                </div>
                @if ($check == 'Inactive')
                    <div class="alert alert-danger" style="padding: 20px;">
                        To activate the Unix theme you need a valid License, You can request the license in our Discord
                        server. <br> We provide 1 license per purchase <br> Discord: <a
                            href="https://pterodactyl-resoures.com/discord">https://pterodactyl-resoures.com/discord</a>
                    </div>
                @endif
                <form action="{{ route('admin.unix.setting') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">License Key</label>
                                <div>
                                    <input type="text" class="form-control" name="l_key"
                                        value="{{ $setting_data['l_key'] ?? 'U_' }}" required />
                                    <p class="text-muted"><small>This is the name of the main button.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Panel URL</label>
                                <div>
                                    <input type="text" class="form-control" disabled value="{{ config('app.url') }}" />
                                    <p class="text-muted"><small>This is the URL of your panel.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-sm btn-primary pull-right">Update License</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
