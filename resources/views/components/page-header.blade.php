<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="fw-bold mb-0">{{ $title }}</h4>
        @isset($subtitle)
            <small class="text-muted">{{ $subtitle }}</small>
        @endisset
    </div>

    @if ($actionRoute && $actionLabel)
        <a href="{{ $actionRoute }}" id="btnTambah" class="btn {{ $actionClass ?? 'btn-primary' }}">
            {{ $actionLabel }}
        </a>
    @endif
</div>
