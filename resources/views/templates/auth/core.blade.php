@section('login')
    <style>
        :root {
            --body-font: "Inter", sans-serif;
            --theme-bg: {{ $setting_data['pcolor'] ?? '#1f1d2b' }};
            --theme-primary-bg: {{ $setting_data['scolor'] ?? '#0000000d' }};
            --theme-secondary-bg: {{ $setting_data['tcolor'] ?? '#0000001a' }};
            --theme-button-bg: {{ $setting_data['buttoncolor'] ?? '#0045ff' }};
            --body-color: {{ $setting_data['textcolor'] ?? '#808191' }};
            --button-bg: #353340;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Lato", sans-serif;
        }

        body {
            background-color: var(--theme-bg) !important;
        }

        #login-bg {
            background-color: var(--theme-bg) !important;
        }

        .LoginFormContainer___StyledDiv-sc-cyh04c-3.cxOtYP {
            background: var(--theme-primary-bg) !important;
        }

        label.Label-sc-g780ms-0.YBQup,
        p {
            color: var(--body-color);
        }

        .iQvIqW:not([type="checkbox"]):not([type="radio"]) {
            background: var(--theme-secondary-bg) !important;
            color: var(--body-active-color) !important;
        }

        .cjgCjC:hover,
        .oHdiU:hover {
            color: var(--body-active-color) !important;
        }

        a,
        .fFWwUW,
        .fFcOT,
        .emCXNB,
        .hmhrLa:not([type="checkbox"]):not([type="radio"])+.input-help,
        .kpuLsi {
            text-decoration: none;
            color: var(--body-color);
        }

        .hmhrLa:not([type="checkbox"]):not([type="radio"]),
        .emoCVo {
            color: var(--body-active-color);
        }

        header {
            position: relative;
        }

        header header::after {
            content: "";
            width: 100%;
            height: 1px;
            position: absolute;
            bottom: 0;
            background-color: white;
            z-index: -1;
        }

        header .menu {
            width: 70%;
            margin: 0 auto;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            min-height: 70px;
        }

        header .logo a {
            color: white;
            font-size: 2rem;
            font-weight: 700;
        }

        header nav a {
            color: ;
            font-size: 1rem;
            font-weight: 300;
            position: relative;
        }

        header nav a:not(:last-child) {
            margin-right: 20px;
        }

        header nav a::after {
            content: "";
            width: 0%;
            height: 2px;
            background-color: #0045ff;
            position: absolute;
            bottom: -3px;
            left: 0;
            transition: all 0.3s;
        }

        header nav a:hover::after {
            width: 100%;
        }

        .btn {
            padding: 15px 30px;
            background-color: var(--theme-button-bg);
            border-radius: 4px;
            color: #fff;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 1px;
            cursor: pointer;
            box-shadow: var(--theme-button-bg) 0px 0 22px;
            transition: all 0.4s;
        }

        .btn:hover {
            box-shadow: 0px 11px 26px 0px rgba(19, 36, 51, 0);
        }

        main {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            height: calc(100vh - 90px);
            width: 70%;
            margin: 0 auto;
        }

        main p {
            color: white;
            margin: 50px 0;
            line-height: 2;
        }

        main .content {
            justify-self: flex-start;
            align-self: center;
        }

        main .content h1 {
            font-size: 4rem;
            color: white;
        }

        main .field-name {
            height: 3.5rem;
            margin-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #dfe1e5;
            border-radius: 4px;
        }

        main .field-name input {
            background: none;
            border: none;
            flex: 1;
            height: 100%;
            outline: none;
        }

        main .field-name .btn {
            margin-right: 5px;
        }

        main .field-name input[type="text"] {
            padding-left: 1.3rem;
            color: white;
        }

        main .illustration {
            justify-self: flex-end;
            align-self: center;
        }

        @media only screen and (max-width: 1250px) {

            main,
            header .menu {
                width: 90%;
            }
        }

        @media only screen and (max-width: 980px) {
            main {
                grid-template-columns: none;
            }

            main .content {
                justify-self: center;
                align-self: center;
                text-align: center;
            }

            main .illustration {
                justify-self: center;
                align-self: flex-start;
                margin-top: 80px;
            }

            main .illustration img {
                width: 100%;
            }
        }

        @media only screen and (max-width: 690px) {
            header .btn {
                display: none;
            }

            header .menu {
                height: 110px;
                flex-direction: column;
                justify-content: space-evenly;
            }

            main {
                margin-top: 50px;
            }

            main .content h1 {
                font-size: 3rem;
            }

            main .illustration {
                justify-self: center;
                align-self: flex-start;
                width: 70%;
                margin-top: 50px;
            }
        }

        @media only screen and (max-width: 370px) {
            main .content h1 {
                font-size: 2.3rem;
            }

            main .field-name {
                display: inline;
                border: none;
            }

            main input[type="text"] {
                padding-left: 1.3rem;
                color: white;
                border: 1px solid #dfe1e5;
                border-radius: 4px;
                width: 100%;
                height: 3.5rem;
            }

            main .btn {
                margin-right: 0;
                margin-top: 20px;
            }
        }
    </style>

    @isset($setting_data['enableloginimg'])
        @if ($setting_data['enableloginimg'] != 1)
            <style>
                #login-image {
                    display: none;
                }
            </style>
        @endif
    @endisset

    @isset($setting_data['loginbgtype'])
        @if ($setting_data['loginbgtype'] == 2)
            <style>
                .bg-neutral-900 {
                    background: url({{ $setting_data['login-bg-img'] ?? 'https://wallpaperaccess.com/full/2002264.png' }}) no-repeat center center / cover;
                    background-attachment: fixed;
                }
            </style>
        @elseif ($setting_data['loginbgtype'] == 3)
            <style>
                @media only screen and (min-width: 1250px) {
                    .body {
                        background-color: transparent !important;
                    }

                    .fullscreen-video-background {
                        background: #000;
                        position: absolute;
                        width: 100%;
                        z-index: -99;
                        overflow: hidden;
                        height: 100vh;
                    }

                    .fullscreen-video-background ._pattern-overlay {
                        position: absolute;
                        top: 0;
                        width: 100%;
                        opacity: 0.15;
                        bottom: 0;
                        z-index: 2;
                    }

                    .fullscreen-video-background #_buffering-background {
                        position: absolute;
                        width: 100%;
                        top: 0;
                        bottom: 0;
                        background: #222;
                        z-index: 1;
                    }

                    .fullscreen-video-background #_youtube-iframe-wrapper {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 100%;
                        position: absolute;
                        height: 100%;
                    }

                    .fullscreen-video-background #_youtube-iframe-wrapper #_youtube-iframe {
                        position: absolute;
                        pointer-events: none;
                        margin: 0 auto;
                        height: 300vh;
                        width: 120vw;
                    }
                }

                @media only screen and (max-width: 1250px) {
                    .bg-neutral-900 {
                        background-image: url({{ $setting_data['login-bg-img'] ?? 'https://wallpaperaccess.com/full/2002264.png' }}) no-repeat center center / cover;
                        background-attachment: fixed;
                    }

                    .fullscreen-video-background {
                        display: none;
                    }

                    .fullscreen-video-background ._pattern-overlay {
                        display: none;
                    }

                    .fullscreen-video-background #_buffering-background {
                        display: none;
                    }

                    .fullscreen-video-background #_youtube-iframe-wrapper {
                        display: none;
                    }

                    .fullscreen-video-background #_youtube-iframe-wrapper #_youtube-iframe {
                        display: none;
                    }
                }
            </style>
        @endif
    @endisset

    @isset($setting_data['login_custom_css'])
        <style>
            {{ $setting_data['login_custom_css'] }}
        </style>
    @endisset
@endsection

@isset($setting_data['loginbgtype'])
    @if ($setting_data['loginbgtype'] == 3)
        @section('loginvideobg')
            <div class="fullscreen-video-background">
                <div class="_pattern-overlay"></div>
                <div id="_buffering-background"></div>
                <div id="_youtube-iframe-wrapper">
                    <div id="_youtube-iframe" data-youtubeurl="{{ $setting_data['login-bg-youtube'] ?? 'edYCtaNueQY' }}">
                    </div>
                </div>
            </div>
        @endsection

        @section('loginvideoscript')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.3.1/velocity.min.js"></script>
            <script>
                const tag = document.createElement('script');
                tag.src = "https://www.youtube.com/iframe_api";
                const firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                const _youtube_id = document.getElementById('_youtube-iframe');

                function onYouTubeIframeAPIReady() {
                    youtubePlayer = new YT.Player('_youtube-iframe', {
                        videoId: _youtube_id.dataset.youtubeurl,
                        playerVars: {
                            cc_load_policy: 0,
                            controls: 0,
                            disablekb: 0,
                            iv_load_policy: 3,
                            playsinline: 1,
                            rel: 0,
                            showinfo: 0,
                            modestbranding: 3
                        },
                        events: {
                            'onReady': onYoutubePlayerReady,
                            'onStateChange': onYoutubePlayerStateChange
                        }
                    });
                }

                function onYoutubePlayerReady(event) {
                    event.target.mute();
                    event.target.playVideo();
                }

                function onYoutubePlayerStateChange(event) {
                    if (event.data == YT.PlayerState.PLAYING) {
                        Velocity(document.getElementById('_buffering-background'), {
                            opacity: 0
                        }, 500);
                    }

                    if (event.data == YT.PlayerState.ENDED) {
                        event.target.playVideo();
                    }
                }
            </script>
        @endsection
    @endif
@endisset

@extends('templates/wrapper', [
    'css' => ['body' => 'bg-neutral-900'],
])

@section('container')
    <header>
        <div id="app"></div>
    </header>
@endsection
