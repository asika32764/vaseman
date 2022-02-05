<ul class="pagination">
    <li class="page-item">
        <a class="page-link" href="#" tabindex="-1">
            <span class="fa fa-chevron-left"></span>
            <span class="sr-only visually-hidden">
                Previous
            </span>
        </a>
    </li>
    @foreach (range(1, 7) as $i)
        <li class="page-item {{ $i === 1 ? 'active' : '' }}">
            <a class="page-link" href="#">
                {{ $i }}
            </a>
        </li>
    @endforeach
    <li class="page-item">
        <a class="page-link" href="#">
            <span class="sr-only visually-hidden">
                Next
            </span>
            <span class="fa fa-chevron-right"></span>
        </a>
    </li>
</ul>
