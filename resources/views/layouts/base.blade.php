<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
    <script type="text/javascript" src="{{ secure_asset('js/verification.js') }}"></script>
</head>

<body id="top">
    @yield('body')
    <footer>
        <div id="copyright">
            <small>Copyright&copy; CompletionHub All Rights Reserved.</small>
            <span class="pr"><a href="http://template-party.com/" target="_blank">《Web Design:Template-Party》</a></span>
        </div>
    </footer>
</body>
</html>
