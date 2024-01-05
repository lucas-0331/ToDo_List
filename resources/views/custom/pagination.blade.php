@if($tasks->hasPages())
    <ul class="pagination justify-content-center">
        @if ($tasks->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="Previous">
                <span class="page-link" aria-hidden="true">&laquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $tasks->previousPageUrl() }}" rel="prev" aria-label="Previous">&laquo;</a>
            </li>
        @endif

        @foreach ($tasks as $task)
            <li class="page-item {{ $task->url($task->currentPage()) == $tasks->url($tasks->currentPage()) ? 'active' : '' }}">
                <a class="page-link" href="{{ $task->url($task->currentPage()) }}">{{ $loop->iteration }}</a>
            </li>
        @endforeach

        @if ($tasks->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $tasks->nextPageUrl() }}" rel="next" aria-label="Next">&raquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="Next">
                <span class="page-link" aria-hidden="true">&raquo;</span>
            </li>
        @endif
    </ul>
@endif
