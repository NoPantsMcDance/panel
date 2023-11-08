@section('meta-base')
    <link rel="preload" href="{{ $setting_data['brand-logo'] ?? '/assets/svgs/pterodactyl.svg' }}" as="image">
    <link rel="stylesheet" href="/themes/unix/css/core.css" />

    @if (Cache::has(Auth::user()->id . '_mode') && Cache::get(Auth::user()->id . '_mode') == 'light')
        <style>
            :root {
                --theme-bg: {{ $setting_data['Light_pcolor'] ?? '#1f1d2b' }};
                --dropdown-bg: {{ $setting_data['Light_pcolor'] ?? '#1f1d2b' }};
                --theme-primary-bg: {{ $setting_data['Light_scolor'] ?? '#0000000d' }};
                --theme-secondary-bg: {{ $setting_data['Light_tcolor'] ?? '#0000001a' }};
                --body-color: {{ $setting_data['Light_textcolor'] ?? '#808191' }};
                --body-active-color: {{ $setting_data['Light_activetextcolor'] ?? 'white' }};
                --button-bg: {{ $setting_data['sb-links-bg'] ?? '#353340' }};
                --theme-button-bg: {{ $setting_data['buttoncolor'] ?? '#0967d3' }};
            }
        </style>
    @else
        <style>
            :root {
                --theme-bg: {{ $setting_data['pcolor'] ?? '#1f1d2b' }};
                --dropdown-bg: {{ $setting_data['pcolor'] ?? '#1f1d2b' }};
                --theme-primary-bg: {{ $setting_data['scolor'] ?? '#0000000d' }};
                --theme-secondary-bg: {{ $setting_data['tcolor'] ?? '#0000001a' }};
                --body-color: {{ $setting_data['textcolor'] ?? '#808191' }};
                --body-active-color: {{ $setting_data['activetextcolor'] ?? 'white' }};
                --button-bg: {{ $setting_data['sb-links-bg'] ?? '#353340' }};
                --theme-button-bg: {{ $setting_data['buttoncolor'] ?? '#0967d3' }};
                --border-color: rgba(128, 129, 145, 0.24);
            }
        </style>
    @endif

    <style>
        .sidebar-link:hover:nth-child(2n + 1) svg,
        .sidebar-link.active:nth-child(2n + 1) svg {
            background: {{ $setting_data['sbactivecolor1'] ?? '#ff7551' }};
        }

        .sidebar-link:hover:nth-child(2n) svg,
        .sidebar-link.active:nth-child(2n) svg {
            background: {{ $setting_data['sbactivecolor2'] ?? '#32a7e2' }};
        }

        .sidebar-link:hover:nth-child(2n + 3) svg,
        .sidebar-link.active:nth-child(2n + 3) svg {
            background: {{ $setting_data['sbactivecolor3'] ?? '#6c5ecf' }};
        }
    </style>

    @isset($setting_data['mainbgtype'])
        @if ($setting_data['mainbgtype'] == 2)
            <style>
                :root {
                    --theme-bg: transparent !important;
                    --theme-primary-bg: #0000004a !important;
                    --theme-secondary-bg: #0000005e !important;
                }

                body {
                    background: url({{ $setting_data['main-bg-img'] ?? 'https://wallpaperaccess.com/full/2002264.png' }}) no-repeat center center / cover;
                    background-attachment: fixed;
                }

                div#FileDropdown,
                .style-module_1RnhIT0w {
                    background: white !important;
                }

                ::-webkit-scrollbar {
                    width: 6px !important;
                }
            </style>
        @endif
    @endisset

    @isset($setting_data['custom_css'])
        <style>
            {{ $setting_data['custom_css'] }}
        </style>
    @endisset

    @isset($setting_data['disable_sidebar'])
        @if ($setting_data['disable_sidebar'] != 1)
            <style>
                #sidebar {
                    display: none !important;
                }
            </style>
        @endif
    @endisset

    @isset($setting_data['topnavbar'])
        @if ($setting_data['topnavbar'] != 1)
            <style>
                .w-full.bg-neutral-900.shadow-md.overflow-x-auto,
                .fTwash,
                .jZPsWO {
                    display: none;
                }
            </style>
        @endif
    @endisset

    @isset($setting_data['sbsmalldevices'])
        @if ($setting_data['sbsmalldevices'] != 1)
            <style>
                @media screen and (max-width: 1090px) {
                    #sidebar.collapse {
                        display: none;
                    }
                }
            </style>
        @endif
    @endisset

    @isset($setting_data['mode'])
        @if ($setting_data['mode'] != 1)
            <style>
                #switch-mode {
                    display: none;
                }
            </style>
        @endif
    @endisset

    @isset($setting_data['enablebrandlogo'])
        @if ($setting_data['enablebrandlogo'] != 1)
            <style>
                #logo-img,
                #mobile-logo {
                    display: none;
                }
            </style>
        @endif
    @endisset
@endsection

@section('script-base')
    {!! Theme::js('vendor/jquery/jquery.min.js?t={cache-version}') !!}

    @isset($setting_data['enablearc'])
        @if ($setting_data['enablearc'] == 1)
            @isset($setting_data['arcID'])
                <script async src="https://arc.io/widget.min.js{{ $setting_data['arcID'] }}"></script>
            @endisset
        @endif
    @endisset

    @isset($setting_data['widgetbot'])
        @if ($setting_data['widgetbot'] == 1)
            <script src="https://cdn.jsdelivr.net/npm/@widgetbot/crate@3" async defer>
                new Crate({
                    server: '{{ $setting_data['discordID'] ?? '760945720470667294' }}',
                    channel: '{{ $setting_data['channelID'] ?? '760945722559299668' }}'
                })
            </script>
        @endif
    @endisset
@endsection

@extends('templates/wrapper', [
    'css' => ['body' => 'bg-neutral-800'],
])

@section('container')
    <div id="modal-portal" style="width: 100%;"></div>
    <div style="width: 100%;" id="app"></div>
@endsection
