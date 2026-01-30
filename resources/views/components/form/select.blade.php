<div class="mb-3">
    <label class="form-label">
        {{ $label }}
        @if($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>

    <select
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        class="form-control @error($name) is-invalid @enderror"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ ($disabled ?? false) ? 'disabled' : '' }}
    >
        <option value="">{{ $placeholder ?? 'Pilih data' }}</option>

        @foreach ($options as $key => $text)
            <option value="{{ $key }}"
                {{ (string) old($name, $value ?? '') === (string) $key ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
