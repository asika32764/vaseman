<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <link rel="shortcut icon" href="{{ $asset->path('images/favicon.png') }}" />

    <title>@yield('title', $helper->page->title($config['title'] ?? ''))</title>

    <!-- Uikit core CSS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/uikit/2.15.0/css/uikit.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/rainbow.min.css" rel="stylesheet"/>
    <link href="{{ $asset->path('css/main.css') }}" rel="stylesheet">

    @if ($config['og']['image'] ?? null)
        <meta property="og:image" content="{{ $config['og']['image'] }}">
    @endif

    @if ($config['og']['desc'] ?? null)
        <meta property="og:description" content="{{ $config['og']['desc'] }}">
    @endif

    @stack('meta')
    @yield('meta')

    @stack('style')

    @stack('head')
</head>
<body class="{{ $helper->page->bodyClass() }} {{ $config['home'] ? 'home' : '' }}">
@yield('superbody')

<script src="{{ $asset->path('vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/uikit/2.15.0/js/uikit.min.js"></script>
<script src="{{ $asset->path() }}vendor/highlight/highlight.pack.js"></script>
<script>
    $(document).ready(function() {
      $('.article-content pre code').each(function(i, block) {
        hljs.highlightBlock(block);
      });
    });
</script>

@stack('script')
</body>
</html>
