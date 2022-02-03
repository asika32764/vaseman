<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var  $app       AppContext      Application context.
 * @var  $vm        object          The view model object.
 * @var  $uri       SystemUri       System Uri information.
 * @var  $chronos   ChronosService  The chronos datetime service.
 * @var  $nav       Navigator       Navigator object to build route.
 * @var  $asset     AssetService    The Asset manage service.
 * @var  $lang      LangService     The language translation service.
 */

declare(strict_types=1);

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

?>

@extends('global.body')

@section('content')
    <div class="container my-5">
        <h2>Acme view</h2>

        <div class="mt-4">
            <ul class="">
                @foreach ($items as $item)
                    <li>
                        <span class="badge bg-secondary">
                            {{ $item->id }}
                        </span>
                        {{ $item->title }}
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
@stop
