{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}


@extends('layouts.admin')
@include('partials/admin.unix.nav', ['activeTab' => 'emails'])

@section('title')
    Unix
@endsection

@section('content-header')
    <h1>Unix Emails<small>Send individuals emails</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.unix') }}">Unix</a></li>
        <li class="active">Emails</li>
    </ol>
@endsection

@section('content')
    @yield('unix::nav')
    <div class="alert alert-info">
        You must setup a SMTP server to send emails - <a style="color: blue" target="_blank"
            href="https://github.com/Mubeen142/billing-docs/wiki/SMTP-Configuration">Setup Documentation</a>
    </div>

    <div class="row">
        <form action="{{ route('admin.mail.send') }}" method="POST">
            @csrf
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Emailing Users</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Username</label>
                                <div>
                                    <input type="text" required="" class="form-control" name="name" value="">
                                    <p class="text-muted small">
                                        The name the user is greeted with in the email.
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Receiver Email Address</label>
                                <div>
                                    <input type="email" required="" class="form-control" name="receiver"
                                        value="">
                                    <p class="text-muted small">
                                        Enter the email address you want to send the email to.
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Email Message</label>
                                <div>
                                    <textarea type="text" required="" class="form-control" name="intro"
                                        placeholder="We are emailing you to inform that..." style="resize: vertical;"></textarea>
                                    <p class="text-muted small">
                                        Body of the email HTML is enabled.
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Email Button Name</label>
                                <div>
                                    <input type="text" required="" class="form-control" name="button_name"
                                        value="{{ config('app.name') }}">
                                    <p class="text-muted small">
                                        Name of the button
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Email Button URL</label>
                                <div>
                                    <input type="text" required="" class="form-control" name="button_url"
                                        value="{{ config('app.url') }}">
                                    <p class="text-muted small">
                                        Set the URL that the button should prompt to
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Email Footer Message</label>
                                <div>
                                    <textarea type="text" required="" class="form-control" name="outro"
                                        placeholder="Looking forward hearing from you..." style="resize: vertical;"></textarea>
                                    <p class="text-muted small">
                                        Bottom part of the email HTML is enabled.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! csrf_field() !!}
                        <button type="submit" name="_method" class="btn btn-sm btn-primary pull-right">Send</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
