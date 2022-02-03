<?php

declare(strict_types=1);

namespace App\View;

use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Pagination\Pagination;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Router\SystemUri;

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext                 Global Application
 * @var $view      ViewModel                       Some information of this view.
 * @var $uri       SystemUri                     Uri information, example: $uri->path
 * @var $chronos   ChronosService   PHP DateTime object of current time.
 * @var $nav       Navigator       Router object.
 * @var $asset     AssetService         The Asset manager.
 * @var $lang     LangService         The Asset manager.
 */

/** @var $pagin Pagination */
// show($pagin->compile());
//
// show($pagin);

?>

@extends('global.body')

@section('content')
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="bg-light py-5">
        <div class="container">
            <h1>Hello, world!</h1>
            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            <p><a href="#" class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>
        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row my-4">
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-default btn-outline-secondary" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-default btn-outline-secondary" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-default btn-outline-secondary" href="#" role="button">View details &raquo;</a></p>
            </div>
        </div>
    </div> <!-- /container -->

{{--    {!! $pagin->render() !!}--}}

{{--    @include('layout.pagination.basic-pagination', ['pagination' => $pagin])--}}
@stop
