<div class="mb-3">
    <label class="form-label">
        {{ $label }}
        @if($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>

    <input
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        value="{{ old($name, $value ?? '') }}"
        class="form-control @error($name) is-invalid @enderror"
        {{ ($required ?? false) ? 'required' : '' }}
    >

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>