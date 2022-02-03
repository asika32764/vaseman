<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $pagination \Windwalker\Core\Pagination\Pagination
 * @var $result \Windwalker\Core\Pagination\PaginationResult
 */

declare(strict_types=1);

$result = $pagination->compile();
?>
<nav aria-label="navigation">
    <ul class="pagination c-pagination">
        @if ($first = $result->getFirst())
        <li class="page-item">
            <a class="page-link" href="{{ $first }}">
                <svg style="height: 1.3em; padding-top: .25em; padding-bottom: .25em"
                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="fast-backward" class="svg-inline--fa fa-fast-backward fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M0 436V76c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v151.9L235.5 71.4C256.1 54.3 288 68.6 288 96v131.9L459.5 71.4C480.1 54.3 512 68.6 512 96v320c0 27.4-31.9 41.7-52.5 24.6L288 285.3V416c0 27.4-31.9 41.7-52.5 24.6L64 285.3V436c0 6.6-5.4 12-12 12H12c-6.6 0-12-5.4-12-12z"></path>
                </svg>
                {{--<span class="sr-only">First</span>--}}
            </a>
        </li>
        @endif

        @if ($previous = $result->getPrevious())
            <li class="page-item">
                <a class="page-link" href="{{ $previous }}">
                    <svg style="height: 1.3em; padding-top: .25em; padding-bottom: .25em"
                        aria-hidden="true" focusable="false" data-prefix="fas" data-icon="backward" class="svg-inline--fa fa-backward fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M11.5 280.6l192 160c20.6 17.2 52.5 2.8 52.5-24.6V96c0-27.4-31.9-41.8-52.5-24.6l-192 160c-15.3 12.8-15.3 36.4 0 49.2zm256 0l192 160c20.6 17.2 52.5 2.8 52.5-24.6V96c0-27.4-31.9-41.8-52.5-24.6l-192 160c-15.3 12.8-15.3 36.4 0 49.2z"></path>
                    </svg>
                    {{--<span class="sr-only">Previous</span>--}}
                </a>
            </li>
        @endif

        @if ($less = $result->getLess())
            <li class="page-item">
                <a class="page-link" href="{{ $less }}">
                    Less
                </a>
            </li>
        @endif

        @foreach ($result->getPages() as $k => $page)
            @php($active = $page->name === \Windwalker\Core\Pagination\Pagination::CURRENT)
            <li class="page-item {{ $active ? 'active' : '' }}">
                <a class="page-link" href="{{ $active ? 'javascript://' : $page }}">
                    {{ $page->page }}
                </a>
            </li>
        @endforeach

        @if ($more = $result->getMore())
            <li class="page-item">
                <a class="page-link" href="{{ $more }}">
                    More
                </a>
            </li>
        @endif

        @if ($next = $result->getNext())
            <li class="page-item">
                <a class="page-link" href="{{ $next }}">
                    {{--<span class="sr-only">Next</span>--}}
                    <svg style="height: 1.3em; padding-top: .25em; padding-bottom: .25em"
                        aria-hidden="true" focusable="false" data-prefix="fas" data-icon="forward" class="svg-inline--fa fa-forward fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M500.5 231.4l-192-160C287.9 54.3 256 68.6 256 96v320c0 27.4 31.9 41.8 52.5 24.6l192-160c15.3-12.8 15.3-36.4 0-49.2zm-256 0l-192-160C31.9 54.3 0 68.6 0 96v320c0 27.4 31.9 41.8 52.5 24.6l192-160c15.3-12.8 15.3-36.4 0-49.2z"></path>
                    </svg>
                </a>
            </li>
        @endif

        @if ($last = $result->getLast())
            <li class="page-item">
                <a class="page-link" href="{{ $last }}">
                    {{--<span class="sr-only">Last</span>--}}
                    <svg style="height: 1.3em; padding-top: .25em; padding-bottom: .25em"
                        aria-hidden="true" focusable="false" data-prefix="fas" data-icon="fast-forward" class="svg-inline--fa fa-fast-forward fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M512 76v360c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12V284.1L276.5 440.6c-20.6 17.2-52.5 2.8-52.5-24.6V284.1L52.5 440.6C31.9 457.8 0 443.4 0 416V96c0-27.4 31.9-41.7 52.5-24.6L224 226.8V96c0-27.4 31.9-41.7 52.5-24.6L448 226.8V76c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12z"></path>
                    </svg>
                </a>
            </li>
        @endif
    </ul>
</nav>
