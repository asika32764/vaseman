@extends('global.body')

@section('body')
    @yield('banner')
    <div class="container main-layout pt-4">
        <div class="row">
            <div class="col-lg-9 main-layout-body">
                <div class="content-wrapper">
                    <div class="content-top">
                        @include('components.breadcrumb')
                    </div>

                    @section('content')
                        {!! $content or 'Content' !!}
                    @show
                </div>
            </div>

            <div class="col-lg-3 main-layout-sidebar">
                <aside class="side-nav sticky-top" style="top: 70px;">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ $helper->menu->active('article/article') }}"
                                href="{{ $uri->path() }}article/article.html">Blade</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $helper->menu->active('article/markdown') }}"
                                href="{{ $uri->path() }}article/markdown.html">Markdown</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                        </li>
                    </ul>
                </aside>
            </div>
        </div>
    </div>
@stop
