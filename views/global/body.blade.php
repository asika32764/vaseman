<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var $view      ViewModel       The view modal object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

declare(strict_types=1);

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

?>

@extends('global.html')

@section('superbody')
    @section('header')

        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{ $asset->path('images/logo-h.svg') }}"
                            alt="Windwalker LOGO"
                            style="height: 25px;"
                        />
                    </a>
                    <button class="navbar-toggler" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    @show

    {{--@section('message')--}}
    {{--    @messages()--}}
    {{--@show--}}

    @section('body')
        @yield('content', 'Content')
    @show

    @section('copyright')
        <div id="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <hr />

                        <footer>
                            &copy; Windwalker {{ $chronos->localNow('Y') }}
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    @show
@stop
