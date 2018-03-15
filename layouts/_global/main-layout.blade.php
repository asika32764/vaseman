@extends('_global.html')

@section('content-wrapper')
    <div class="container main-layout">
        <div class="row">
            <div class="col-lg-9 main-layout-body">
                @yield('content', 'Content')
            </div>

            <div class="col-lg-3 main-layout-sidebar">
                <aside class="side-nav sticky-top" style="top: 70px;">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
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
