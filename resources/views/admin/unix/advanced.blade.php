{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.admin')
@include('partials/admin.unix.nav', ['activeTab' => 'advanced'])

@section('title')
    Unix Advanced
@endsection

@section('content-header')
    <h1>Unix<small>Configure advanced settings</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.unix') }}">Unix</a></li>
        <li class="active">Advanced</li>
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
                        <h3 class="box-title">Advanced Unix Settings</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Sidebar Active Color #1</label>
                                    <div>
                                        <input class="form-control" name="sbactivecolor1"
                                            value="{{ $setting_data['sbactivecolor1'] ?? '#ff7551' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                This is the color of the first sidebar button.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Sidebar Active Color #2</label>
                                    <div>
                                        <input class="form-control" name="sbactivecolor2"
                                            value="{{ $setting_data['sbactivecolor2'] ?? '#32a7e2' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                This is the color of the second sidebar button.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Sidebar Active Color #3</label>
                                    <div>
                                        <input class="form-control" name="sbactivecolor3"
                                            value="{{ $setting_data['sbactivecolor3'] ?? '#6c5ecf' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                This is the color of the third sidebar button.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Display sidebar on smaller devices?</label>
                                    <div>
                                        <select class="form-control" name="sbsmalldevices" required>
                                            <option value="0"
                                                @isset($setting_data['sbsmalldevices']) @if ($setting_data['sbsmalldevices'] != 1) selected @endif @endisset>
                                                False
                                            </option>
                                            <option value="1"
                                                @isset($setting_data['sbsmalldevices']) @if ($setting_data['sbsmalldevices'] == 1) selected @endif @endisset>
                                                True
                                            </option>
                                        </select>
                                        <p class="text-muted">
                                            <small>
                                                Should the sidebar be displayed on smaller devices such as phones?
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Sidebar button & Search bar background</label>
                                    <div>
                                        <input class="form-control" name="sb-links-bg"
                                            value="{{ $setting_data['sb-links-bg'] ?? '#353340' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                This is the background color of the sidebar & searchbar
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Enable sidebar?</label>
                                    <div>
                                        <select class="form-control" name="disable_sidebar" required>
                                            <option value="0"
                                                @isset($setting_data['disable_sidebar']) @if ($setting_data['disable_sidebar'] != 1) selected @endif @endisset>
                                                Disable
                                            </option>
                                            <option value="1"
                                                @isset($setting_data['disable_sidebar']) @if ($setting_data['disable_sidebar'] == 1) selected @endif @endisset>
                                                Enable
                                            </option>
                                        </select>
                                        <p class="text-muted">
                                            <small>
                                                Enable or Disable the Sidebar
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

    <div class="col-xs-12">
        <form action="{{ route('admin.unix.setting') }}" method="POST">
            @csrf
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Custom CSS</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Panel Custom CSS</label>
                                <div>
                                    <textarea type="text" class="form-control" name="custom_css" required style="resize: vertical;">{{ $setting_data['custom_css'] ?? '' }}</textarea>
                                    <p class="text-muted">
                                        <small>
                                            Add your CSS here, use bottom right label to enlargen
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Login Custom CSS</label>
                                <div>
                                    <textarea type="text" class="form-control" name="login_custom_css" required style="resize: vertical;">{{ $setting_data['login_custom_css'] ?? '' }}</textarea>
                                    <p class="text-muted">
                                        <small>
                                            Add your CSS here, use bottom right label to enlargen
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
