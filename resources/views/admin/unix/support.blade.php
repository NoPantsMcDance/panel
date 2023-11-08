{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.admin')
@include('partials/admin.unix.nav', ['activeTab' => 'support'])

@section('title')
    Unix Support
@endsection

@section('content-header')
    <h1>Unix<small>Need help? Join our Discord</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.unix') }}">Unix</a></li>
        <li class="active">Support</li>
    </ol>
@endsection

@section('content')
    @yield('unix::nav')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Support - Debug Information</h3>
                </div>
                <div style="padding: 15px;">
                    <h4>Active Theme: <strong>{{ config('unix.name', 'Unix') }}</strong></h4>
                    <h4>Version: <strong>{{ config('unix.version') }}</strong></h4>
                    <h4>Authors: <strong>{{ config('unix.author', 'Mubeen and GIGABAIT') }}</strong></h4>
                </div>
                <button onclick="window.location.href='https://pterodactyl-resources.com/discord'" class="btn btn-primary"
                    style="width:100%;"><i class="fas fa-fw fa-question-circle"></i> Support Discord Server</button>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Frequently Asked Questions</h3>
                </div>
                <div style="padding: 15px;">
                    <h4>How can I edit the emails sent to users?</h4>
                    <p>
                        Email layouts can be modified in the following file:
                        <code>{{ base_path() }}/config/unix/mail.php</code>
                    </p>
                    <br>
                    <h4>How do I update the Unix theme?</h4>
                    <p>
                        Updating the Unix theme is very simple, upload the latest unix files to
                        <code>{{ base_path() }}</code>, then run <code>yarn build:production</code>
                    </p>
                    <br>
                    <h4>Where can I write large amounts of custom CSS</h4>
                    <p>
                        Custom CSS in Advanced settings is meant for small amounts of custom css, if you wish to apply large
                        amount of css you can do so by edit the following files:
                        <br>
                        Client/Panel Overview <code>{{ base_path() }}/public/themes/unix/css/core.css</code>
                        <br>
                        Do not that if you wish for us to write custom CSS code for you, it will cost an additional fee.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
