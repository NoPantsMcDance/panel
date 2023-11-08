{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.admin')
@include('partials/admin.unix.nav', ['activeTab' => 'connect'])

@section('title')
    Unix Connectivity
@endsection

@section('content-header')
    <h1>Unix<small>Configure additional services</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.unix') }}">Unix</a></li>
        <li class="active">Connectivity</li>
    </ol>
@endsection

@section('content')
    @yield('unix::nav')
    <div class="row">
        <form action="{{ route('admin.unix.setting') }}" method="POST">
            @csrf
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Unix Connectivity</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Enable Widgetbot?</label>
                                    <div>
                                        <select class="form-control" name="widgetbot" required>
                                            <option value="0" @isset($setting_data['widgetbot']) @if ($setting_data['widgetbot'] != 1) selected @endif @endisset>
                                                Disabled
                                            </option>
                                            <option value="1" @isset($setting_data['widgetbot']) @if ($setting_data['widgetbot'] == 1) selected @endif @endisset>
                                                Enabled
                                            </option>
                                        </select>
                                        <p class="text-muted">
                                            <small>
                                                Do you want to enable WidgetBot?
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Widgetbot Discord ID</label>
                                    <div>
                                        <input type="text" class="form-control" name="discordID"
                                            value="{{ $setting_data['discordID'] ?? '' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                This is the ID of your Discord server(not invite).
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Widgetbot Discord ID</label>
                                    <div>
                                        <input type="text" class="form-control" name="channelID"
                                            value="{{ $setting_data['channelID'] ?? '' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                This is ID of the Channel first displayed by WidgetBot.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Enable Arc?</label>
                                    <div>
                                        <select class="form-control" name="enablearc" required>
                                            <option value="0" @isset($setting_data['enablearc']) @if ($setting_data['enablearc'] != 1) selected @endif @endisset>
                                                Disabled
                                            </option>
                                            <option value="1" @isset($setting_data['enablearc']) @if ($setting_data['enablearc'] == 1) selected @endif @endisset>
                                                Enabled
                                            </option>
                                        </select>
                                        <p class="text-muted">
                                            <small>
                                                Arc is a peer-to-peer content exchange and delivery network (CDN).
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Arc.io</label>
                                    <div>
                                        <input type="text" class="form-control" name="arcID"
                                            value="{{ $setting_data['arcID'] ?? '#' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                Enter your arc token, it might look like this: #ZurMK1Hv
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
