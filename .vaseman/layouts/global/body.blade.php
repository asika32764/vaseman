@extends('global.html')

@push('meta')
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-48372917-1', 'auto');
        ga('send', 'pageview');

    </script>
@endpush

@section('superbody')
@section('header')
<nav id="header" class="uk-navbar uk-navbar-attached">
    <div class="uk-container uk-container-center">

        <a id="big-logo" class="uk-navbar-brand uk-hidden-small" href="{{ $uri->path() }}">
            <img class="uk-margin uk-margin-remove" src="{{ $asset->path() }}images/logo/vaseman-logo-noslogen-200.png" title="Asukademy" alt="Asukademy">
        </a>

        <a href="#" class="uk-navbar-toggle uk-visible-small" data-uk-toggle="{target:'#mainmenu', cls: 'uk-hidden-small'}"></a>

        <a id="small-logo" class="uk-navbar-brand uk-navbar-center uk-visible-small" href="{{ $uri->path() }}">
            <img class="uk-margin uk-margin-remove" style="max-width: 95%;" src="{{ $asset->path() }}images/logo/vaseman-logo-noslogen-200.png" title="Asukademy" alt="Asukademy">
        </a>

        <ul id="mainmenu" class="uk-navbar-nav uk-float-right uk-hidden-small">
            <li class="">
                <a href="{{ $uri->path() }}documentation/getting-started.html">
                    <span class="menu-item-title">Documentation</span>
                </a>
            </li>

            <li class="">
                <a href="https://github.com/asika32764/vaseman" target="_blank">
                    <span class="menu-item-title">GitHub</span>
                </a>
            </li>
        </ul>

    </div>
</nav>
@show

<section id="banner">
    <div class="banner-inner">
        @yield('banner')
    </div>
</section>

<div id="main-body">
    @section('body')
    <section id="home" class="main-block">
        <div class="uk-container uk-container-center">
            <div class="uk-grid" data-uk-grid-match>
                <div class="uk-width-medium-1-1">

                        @yield('content', $content ?? '')

                </div>
            </div>
        </div>
    </section>
    @show
</div>

@section('copyright')
<footer id="footer">
    <div class="uk-container uk-container-center uk-text-center">

        <div class="footer-logo">
            <a href="#" data-uk-smooth-scroll>
                <img src="{{ $asset->path() }}images/logo/vaseman-logo-noslogen-200.png" width="150" alt="Footer LOGO">
            </a>
        </div>

        <p class="uk-text-center social-buttons">
            <a target="_blank" class="uk-icon-button uk-icon-facebook" href="javascript: void(0);"></a>

            <a target="_blank" class="uk-icon-button uk-icon-github" href="https://github.com/asika32764/vaseman"></a>

            <a class="uk-icon-button uk-icon-envelope-o" href="mailto:asika32764@gmail.com"></a>
        </p>

        <p>
            Copyright &copy; {{ date('Y') }} Vaseman. All Rights Reserved.
        </p>
        <p class="back">
            <a href="#" data-uk-smooth-scroll><span class="uk-icon-chevron-up"></span> Back to Top</a>
        </p>
    </div>
</footer>
@show


@stop
