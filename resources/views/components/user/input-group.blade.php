@php
    $isError = isset($name) && $errors->has($name);
@endphp
<div>
    <label class="form-label {{ isset($required) ? 'required' : '' }}">{{ $label ?? '' }}</label>
    <div class="input-group">
        <input {{ $attributes->class(['form-control', 'border-end-0', $isError ? 'is-invalid' : '']) }}>

        <a href="javascript:;" class="input-group-text bg-transparent {{ $isError ? 'border-danger' : '' }}"><i
                class="{{ $icon }}"></i></a>

        @isset($name)
            @error($name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        @endisset
    </div>
</div>
