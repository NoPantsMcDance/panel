<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name', 'Pterodactyl') }}</title>

    @section('meta')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex">
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ $setting_data['unixfavicon'] ?? '/favicons/apple-touch-icon.png' }}">
        <link rel="icon" type="image/png" href="{{ $setting_data['unixfavicon'] ?? '/favicons/favicon-32x32.png' }}"
            sizes="32x32">
        <link rel="icon" type="image/png" href="{{ $setting_data['unixfavicon'] ?? '/favicons/favicon-16x16.png' }}"
            sizes="16x16">
        <link rel="manifest" href="/favicons/manifest.json">
        <link rel="mask-icon" href="{{ $setting_data['unixfavicon'] ?? '/favicons/safari-pinned-tab.svg' }}"
            color="#bc6e3c">
        <link rel="shortcut icon" href="{{ $setting_data['unixfavicon'] ?? 'favicons/favicon.ico' }}">
        <meta name="msapplication-config" content="/favicons/browserconfig.xml">
        <meta name="theme-color" content="{{ $setting_data['metacolor'] ?? '#0045ff' }}">
        <meta property="og:title" content="{{ $setting_data['metatitle'] ?? config('app.name', 'Pterodactyl') }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="/">
        <meta property="og:image" content="{{ $setting_data['metaimg'] ?? 'favicons/favicon.ico' }}">
        <meta property="og:description"
            content="{{ $setting_data['metadesc'] ?? 'Manage your server with an easy-to-use Panel' }}">
    @show

    @yield('meta-base')

    @section('user-data')
        @if (!is_null(Auth::user()))
            <script>
                window.PterodactylUser = {!! json_encode(Auth::user()->toVueObject()) !!};
                window.userlogo = '{{ md5(strtolower(Auth::user()->email)) }}';
            </script>
            @isset($setting_data['viewname'])
                @if ($setting_data['viewname'] == 1)
                    @if (Auth::user()->root_admin)
                        <script>
                            window.headername = '{{ Auth::user()->name_first }} {{ Auth::user()->name_last }}';
                        </script>
                    @endif
                @else
                    <script>
                        window.headername = '{{ Auth::user()->name_first }} {{ Auth::user()->name_last }}';
                    </script>
                @endif
            @endisset
        @endif
        @if (!empty($siteConfiguration))
            <script>
                window.SiteConfiguration = {!! json_encode($siteConfiguration) !!};
            </script>
        @endif

        @isset($setting_data['l_key'])
            @php unset($setting_data['l_key']); @endphp
        @endisset

        @isset($setting_data)
            <script>
                window.settings = {!! json_encode($setting_data) !!};
                window.copyright = '{{ config('unix.author', 'n/a') }} {{ config('unix.version', 'unset') }}';
            </script>
        @endisset
    @show

    <style>
        @import url('//fonts.googleapis.com/css?family=Rubik:300,400,500&display=swap');
        @import url('//fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:500&display=swap');
    </style>

    @yield('login')
    @yield('assets')

    @include('layouts.scripts')
</head>

<body class="{{ $css['body'] }}">
    @yield('loginvideobg')
    <!-- Neko Modifications -->
    <style>
        .bRjKTU:hover{
            border-color: #ff0000 !important;
        }
    </style>
    @section('content')
        @yield('above-container')
        @yield('container')
        @yield('below-container')
    @show

    @section('scripts')
        {!! $asset->js('main.js') !!}
        @yield('script-base')
    @show

    @yield('loginvideoscript')
</body>

</html>
