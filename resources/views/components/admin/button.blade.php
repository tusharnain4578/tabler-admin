@php
    $variant = $variant ?? 'primary';
    $attributes = $attributes->class(['btn ms-auto', "btn-$variant"])->except(['submit']);
@endphp

<button type="{{ isset($submit) ? 'submit' : 'button' }}" {{ $attributes }}>
    @isset($icon)
        <i class="{{ $icon }} fs-2 me-2"></i>
    @endisset
    {{ $label ?? '' }}
</button>
