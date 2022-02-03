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

@section('header')
    <div class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ $uri->path() }}">EARTH</a>

            <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                data-bs-target="#top-navbar-content" aria-controls="#top-navbar-content" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="top-navbar-content" class="collapse navbar-collapse">
                <ul class="nav navbar-nav mr-auto">
                    @section('nav')
                        @include('admin.global.layout.mainmenu')
                    @show
                </ul>
                <ul class="nav navbar-nav navbar-right ms-auto">
                    <li class="nav-item">
                        <a href="{{ $nav->to('front::home')->mute() }}" target="_blank"
                            class="nav-link" title="Preview"
                            data-bs-toggle="tooltip"
                            data-placement="bottom">
                            <span class="fa-regular fa-eye"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--/.nav-collapse -->
    </div>

@show
