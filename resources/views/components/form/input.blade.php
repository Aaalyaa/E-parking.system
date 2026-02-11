<div class="mb-3">
    <label class="form-label">
        {{ $label }}
        @if ($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>

    @if(($type ?? 'text') === 'password' && ($showToggle ?? false))
        <div class="input-group">
            <input 
                type="password"
                name="{{ $name }}"
                value="{{ old($name, $value ?? '') }}"
                id="{{ $name }}"
                {{ $attributes->merge([
                    'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : ''),
                ]) }}
                {{ $required ?? false ? 'required' : '' }}
            >

            <button class="btn btn-outline-primary toggle-password" 
                    type="button"
                    data-target="{{ $name }}">
                <i class="bi bi-eye"></i>
            </button>
        </div>
    @else
        <input 
            type="{{ $type ?? 'text' }}"
            name="{{ $name }}"
            value="{{ old($name, $value ?? '') }}"
            {{ $attributes->merge([
                'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : ''),
            ]) }}
            {{ $required ?? false ? 'required' : '' }}
        >
    @endif

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>