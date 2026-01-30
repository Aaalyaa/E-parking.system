<div class="mb-3">
    <label class="form-label">
        {{ $label }}
        @if($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>

    <input
        type="file"
        name="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror"
        {{ ($required ?? false) ? 'required' : '' }}
    >

    @if(!empty($preview))
        <div class="mt-2">
            <img
                src="{{ asset('storage/' . $preview) }}"
                alt="Preview"
                class="img-thumbnail"
                style="max-width: 120px;"
            >
        </div>
        <small class="text-muted">
            Kosongkan jika tidak ingin mengganti file
        </small>
    @endif

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>