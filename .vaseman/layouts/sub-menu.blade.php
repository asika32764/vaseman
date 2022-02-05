<ul class="uk-nav uk-nav-side side-menu side-bar" data-uk-nav="">
    @foreach ($menus as $title => $section)
        <li class="uk-nav-header">{{ $title }}</li>

        @foreach ($section as $id => $item)
            <li class="{{ $helper->menu->active("documentation/$id", 'uk-active') }}">
                <a href="{{ $uri->path }}documentation/{{ $id }}.html">{{ $item }}</a>
            </li>
        @endforeach

        <li class="uk-nav-divider"></li>

    @endforeach
</ul>
