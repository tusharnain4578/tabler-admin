<button type="{{ isset($submit) ? 'submit' : 'button' }}"
    {{ $attributes->class(['btn d-flex gap-2 px-5', isset($variant) ? "btn-$variant" : 'btn-primary']) }}>
    @isset($icon)
        <i class="{{ $icon }}"></i>
    @endisset
    {{ $label ?? '' }}
</button>
