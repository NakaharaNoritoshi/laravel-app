<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>お問い合わせフォーム</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'public/css/style.css', 'resources/js/api.js'])
</head>

<body>
    @yield('content')
    @livewireScripts
</body>
    <script defer src="{{ mix('resources/js/api.js') }}"></script>
</html>
