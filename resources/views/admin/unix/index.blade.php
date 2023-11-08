{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}


@extends('layouts.admin')
@include('partials/admin.unix.nav', ['activeTab' => 'basic'])

@section('title')
    Unix
@endsection

@section('content-header')
    <h1>Unix<small>Configure the theme with ease</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Unix</li>
    </ol>
@endsection

@section('content')
    @yield('unix::nav')
    @isset($status)
        @if ($status == 1)
            <meta http-equiv="refresh" content="2; url = /admin/unix" />
            <div class="alert alert-success alert-white rounded">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <div class="icon"><i class="fa fa-check"></i></div>
                <div style="padding-left:40px;"><strong>Success!</strong> Changes has been saved successfully!</div>
            </div>
        @endif
    @endisset

    <div class="row">
        <form action="{{ route('admin.unix.setting') }}" method="POST">
            @csrf
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Unix Configuration</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Login page logo</label>
                                <div>
                                    <input type="text" class="form-control" id="image-logo" name="logourl"
                                        value="{{ $setting_data['logourl'] ?? '/assets/svgs/pterodactyl.svg' }}" required />
                                    <p class="text-muted">
                                        <small>
                                            This is the logo displayed on the login page etc
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Brand Logo</label>
                                <div>
                                    <input type="text" class="form-control" id="brand-logo" name="brand-logo"
                                        value="{{ $setting_data['brand-logo'] ?? '/assets/svgs/pterodactyl.svg' }}"
                                        required />
                                    <p class="text-muted">
                                        <small>
                                            This is the logo displayed top right of the login & panel page
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Favicon</label>
                                <div>
                                    <input type="text" class="form-control" id="favicon" name="unixfavicon"
                                        value="{{ $setting_data['unixfavicon'] ?? '/assets/svgs/pterodactyl.svg' }}"
                                        required />
                                    <p class="text-muted">
                                        <small>
                                            This is the favicon displayed in browsers
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Enable image in login page?</label>
                                <div>
                                    <select class="form-control" name="enableloginimg" required>
                                        <option value="0" @isset($setting_data['enableloginimg']) @if($setting_data['enableloginimg'] != 1) selected @endif @endisset>
                                            Disabled
                                        </option>
                                        <option value="1" @isset($setting_data['enableloginimg']) @if ($setting_data['enableloginimg'] == 1) selected @endif @endisset>
                                            Enabled
                                        </option>
                                    </select>
                                    <p class="text-muted">
                                        <small>
                                            Enable or Disable your logo in login page.
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Enable brand logo?</label>
                                <div>
                                    <select class="form-control" name="enablebrandlogo" required>
                                        <option value="0" @isset($setting_data['enablebrandlogo'])  @if ($setting_data['enablebrandlogo'] != 1) selected @endif @endisset>
                                            Disabled
                                        </option>
                                        <option value="1" @isset($setting_data['enablebrandlogo']) @if ($setting_data['enablebrandlogo'] == 1) selected @endif @endisset>
                                            Enabled
                                        </option>
                                    </select>
                                    <p class="text-muted">
                                        <small>
                                            Should the navigation bar in the homepage be enabled or disabled
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Enable top navbar?</label>
                                <div>
                                    <select class="form-control" name="topnavbar" required>
                                        <option value="0" @isset($setting_data['topnavbar']) @if ($setting_data['topnavbar'] != 1) selected @endif @endisset>
                                            Disabled
                                        </option>
                                        <option value="1" @isset($setting_data['topnavbar'])  @if ($setting_data['topnavbar'] == 1) selected @endif @endisset>
                                            Enabled
                                        </option>
                                    </select>
                                    <p class="text-muted">
                                        <small>
                                            Should the navigation bar be enabled or disabled
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Who can view their name top right</label>
                                <div>
                                    <select class="form-control" name="viewname" required>
                                        <option value="1" @isset($setting_data['viewname']) @if ($setting_data['viewname'] == 1) selected @endif @endisset>
                                            Admin only
                                        </option>
                                        <option value="2" @isset($setting_data['viewname']) @if ($setting_data['viewname'] != 1) selected @endif @endisset>
                                            Everyone
                                        </option>
                                    </select>
                                    <p class="text-muted">
                                        <small>
                                            Who can view their name top right?
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <a onclick="ResetToDefault()" class="btn btn-sm btn-primary pull-left"
                            style="background: rgb(207, 65, 65); border-color: rgb(207, 65, 65);">
                            Reset to Default
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Darkmode Color Config</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Primary Background Color</label>
                                    <div>
                                        <input class="form-control" id="pcolor" name="pcolor"
                                            value="{{ $setting_data['pcolor'] ?? '#1f1d2b' }}" required="">
                                        <p class="text-muted">
                                            <small>
                                                This is the primary background template color.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Secondary Background Color</label>
                                    <div>
                                        <input class="form-control" id="scolor" name="scolor"
                                            value="{{ $setting_data['scolor'] ?? '#0000000d' }}" required="">
                                        <p class="text-muted">
                                            <small>
                                                This is the Secondary background template color.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Tertiary Background Color</label>
                                    <div>
                                        <input class="form-control" id="tcolor" name="tcolor"
                                            value="{{ $setting_data['tcolor'] ?? '#0000001a' }}" required="">
                                        <p class="text-muted">
                                            <small>
                                                This is the Tertiary background template color.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Text Color</label>
                                    <div>
                                        <input class="form-control" id="text-color" name="textcolor"
                                            value="{{ $setting_data['textcolor'] ?? '#808191' }}" required="">
                                        <p class="text-muted">
                                            <small>
                                                This is the color of the text.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Active Text Color</label>
                                    <div>
                                        <input class="form-control" id="active-text-color" name="activetextcolor"
                                            value="{{ $setting_data['activetextcolor'] ?? 'white' }}" required="">
                                        <p class="text-muted">
                                            <small>
                                                This is the color displayed when buttons are active or selected.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Button Color</label>
                                    <div>
                                        <input class="form-control" id="button-color" name="buttoncolor"
                                            value="{{ $setting_data['buttoncolor'] ?? '#0967d3' }}" required="">
                                        <p class="text-muted">
                                            <small>
                                                This is the color of the buttons on the pages.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a onclick="ResetToDefaultDark()" class="btn btn-sm btn-primary pull-left"
                            style="background: rgb(207, 65, 65); border-color: rgb(207, 65, 65);">
                            Reset to Default
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lightmode Color Config</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Primary Background Color</label>
                                    <div>
                                        <input class="form-control" id="Light_pcolor" name="Light_pcolor"
                                            value="{{ $setting_data['Light_pcolor'] ?? '#f0f2fa' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                This is the primary background template color.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Secondary Background Color</label>
                                    <div>
                                        <input class="form-control" id="Light_scolor" name="Light_scolor"
                                            value="{{ $setting_data['Light_scolor'] ?? '#ffffff' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                This is the Secondary background template color.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Tertiary Background Color</label>
                                    <div>
                                        <input class="form-control" id="Light_tcolor" name="Light_tcolor"
                                            value="{{ $setting_data['Light_tcolor'] ?? '#eff0f6' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                This is the Tertiary background template color.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Text Color</label>
                                    <div>
                                        <input class="form-control" id="Light_textcolor" name="Light_textcolor"
                                            value="{{ $setting_data['Light_textcolor'] ?? '#767676' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                This is the color of the text.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Active Text Color</label>
                                    <div>
                                        <input class="form-control" id="Light_activetextcolor"
                                            name="Light_activetextcolor"
                                            value="{{ $setting_data['Light_activetextcolor'] ?? 'black' }}" required />
                                        <p class="text-muted">
                                            <small>
                                                This is the color displayed when buttons are active or selected.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">Enable Dark / Light Mode Switch</label>
                                    <div>
                                        <select class="form-control" name="mode" required>
                                            <option value="0" @isset($setting_data['mode']) @if ($setting_data['mode'] != '1') selected @endif @endisset>
                                                False
                                            </option>
                                            <option value="1" @isset($setting_data['mode']) @if ($setting_data['mode'] == '1') selected @endif @endisset>
                                                True
                                            </option>
                                        </select>
                                        <p class="text-muted">
                                            <small>
                                                Should users be able to change the mode?
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            {!! csrf_field() !!}
                            <a onclick="ResetToDefaultLight()" class="btn btn-sm btn-primary pull-left"
                                style="background: rgb(207, 65, 65); border-color: rgb(207, 65, 65);">
                                Reset to Default
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary pull-right">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function ResetToDefault() {
            $("#image-logo").val("/assets/svgs/pterodactyl.svg");
            $("#brand-logo").val("/assets/svgs/pterodactyl.svg");
            $("#favicon").val("/assets/svgs/pterodactyl.svg");
        }

        function ResetToDefaultDark() {
            $("#pcolor").val("#1f1d2b");
            $("#scolor").val("#0000000d");
            $("#tcolor").val("#0000001a");
            $("#text-color").val("#808191");
            $("#active-text-color").val("white");
            $("#button-color").val("#0967d3");
        }

        function ResetToDefaultLight() {
            $("#Light_pcolor").val("#f0f2fa");
            $("#Light_scolor").val("#ffffff");
            $("#Light_tcolor").val("#eff0f6");
            $("#Light_textcolor").val("#767676");
            $("#Light_activetextcolor").val("black");
        }
    </script>
@endsection
