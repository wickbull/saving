<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <title>Starlight - @yield('title')</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="{{ rev('all.css') }}" type="text/css">

        <script>
            window.App = {};

            window.App.staticHost           = '{{ config('app.static_url') }}'.replace(/\/$/, '') + '/';
            window.App.baseHost             = '{{ action('HomeController@getIndex') }}'.replace(/\/$/, '') + '/';
            window.App.token_encrypted      = '{{ Crypt::encrypt(csrf_token()) }}';
            window.App.ckeditorGalleryUrl   = '{{ action('HomeController@getSliders') }}';

            window.App.scriptMap = {};
            window.App.conf      = {};
        </script>

    </head>
    <body>
        <div class="app app-header-fixed app-aside-fixed">

            @yield('layout')

        </div>

        @include('parts.gallery-modal')
        @include('js')

        <script src="{{ rev('app.js') }}"></script>
        <script>App.run();</script>

    </body>
</html>
