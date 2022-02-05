---
home: true
meta:
    desc: 'Vaseman is a PHP static site and prototype Generator. Support both Twig and Blade engines.'
og:
    image: https://i.imgur.com/PMeUSye.png
---
@extends('global.body')

@section('banner')
    <div class="banner-title">
        <h1>VASEMAN</h1>
        <h2>Static Site And Prototype Generator</h2>
        <h3>He is Nothing But Pretty Face</h3>
    </div>
@stop

@section('body')
    <section id="features" class="main-block">
        <div class="uk-container uk-container-center">
            <div class="uk-grid" data-uk-grid-match>
                <div class="uk-width-medium-1-3 feature-block">
                    <img class="uk-border-rounded" src="{{ $asset->path() }}images/features/php.png" alt="" />
                    <h2>Blade Templates</h2>
                    <p>
                        Vaseman is a PHP project, you can easily create static sites by our Blade compatible engines
                        (<a href="https://github.com/windwalker-io/edge" target="_blank">Edge</a>) or use Markdown to write documentation.
                    </p>
                </div>

                <div class="uk-width-medium-1-3 feature-block">
                    <img class="uk-border-rounded" src="{{ $asset->path() }}images/features/design.png" alt="" />
                    <h2>Easy Designing</h2>
                    <p>
                        Vaseman use Blade as template engine, you can write your own logic in every page.
                        We also provide Markdown Extra parser to help you write article quickly.
                    </p>
                </div>

                <div class="uk-width-medium-1-3 feature-block">
                    <img class="uk-border-rounded" src="{{ $asset->path() }}images/features/lab.png" alt="" />
                    <h2>Prototyping</h2>
                    <p>
                        Vaseman is very simple but powerful. You can easily create a simple prototype or a complex site,
                        then output to static files and host on cloud.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="start" class="main-block">
        <div class="uk-container uk-container-center">
            <div class="uk-grid" data-uk-grid-match>
                <div class="uk-width-medium-1-1 article-content">
                    <h1 class="page-title">Quick Start</h1>
                    <p>
                    <pre class="home-start-code"><code style="font-size: 20px;">composer global require asika/vaseman</code></pre>
                    </p>
                    <p class="uk-text-center">
                        <a style="margin-top: 50px; width: 400px" class="download-button uk-button uk-button-hero uk-button-primary"
                            href="{{ $uri->path() }}documentation/getting-started.html">
                            Documentation
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="powered" class="main-block">
        <div class="uk-container uk-container-center">
            <div class="uk-grid" data-uk-grid-match>
                <div class="uk-width-medium-1-1">
                    <h1 class="page-title">Powered By Windwalker Framework</h1>
                    <p class="uk-text-center">
                        <a target="_blank" href="https://windwalker.io">
                            <img style="width: 500px;" src="{{ $asset->path('images/logo/windwalker-logo.png') }}" alt="Windwalker" />
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@stop
