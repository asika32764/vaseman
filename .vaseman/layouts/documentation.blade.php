@extends('global.body')

@section('title', ($config['title'] ?? '') .  ' | Vaseman, Static Site Generator with Blade Engine')

@section('banner')
    <div class="uk-container uk-container-center banner-inner-title">
        <h1>{{ $config['title'] ?? '' }}</h1>
    </div>
@stop

@section('body')
    <section class="uk-container uk-container-center">
        <div class="uk-grid">
            <div class="uk-width-medium-1-4 uk-container-center">
                @include('sub-menu')
            </div>

            <div class="uk-width-medium-3-4 uk-container-center">
                <article class="article-content">
                    {!! $content !!}

                    <p class="uk-text-center">
                        Help <a target="_blank" href="https://github.com/asika32764/vaseman/tree/docs/.vaseman/entries/documentation">improve</a> our documentation
                    </p>
                </article>
            </div>
        </div>
    </section>
@stop
