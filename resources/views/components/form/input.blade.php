<div class="mb-3">
    <label class="form-label">
        {{ $label }}
        @if ($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>

    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" value="{{ old($name, $value ?? '') }}"
        {{ $attributes->merge([
            'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : ''),
        ]) }}
        {{ $required ?? false ? 'required' : '' }}>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
