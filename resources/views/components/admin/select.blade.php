<div class="select-wrapper mb-3">
    <label class="form-label {{ isset($required) ? 'required' : '' }}">
        {{ $label }}
    </label>
    <select {{ $attributes->class(['form-select']) }}>
        {{ $slot }}
    </select>
    @isset($name)
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    @endisset
</div>
