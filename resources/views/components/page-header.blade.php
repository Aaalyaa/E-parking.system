<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">{{ $title }}</h4>

    @if ($actionRoute && $actionLabel)
        <a href="{{ $actionRoute }}" class="btn {{ $actionClass ?? 'btn-primary' }}">
            {{ $actionLabel }}
        </a>
    @endif
</div>