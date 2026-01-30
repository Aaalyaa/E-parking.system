<div class="mb-3">
    <label class="form-label">
        {{ $label }}
        @if($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>

    <textarea
        name="{{ $name }}"
        rows="{{ $rows ?? 3 }}"
        class="form-control @error($name) is-invalid @enderror"
        {{ ($required ?? false) ? 'required' : '' }}
    >{{ old($name, $value ?? '') }}</textarea>

    @if(!empty($hint))
        <small class="text-muted">{{ $hint }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
