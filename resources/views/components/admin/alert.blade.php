@php
    $variant = $variant ?? 'primary';

    $attributes = $attributes
        ->class([
            'alert',
            "alert-$variant",
            isset($close) ? 'alert-dismissible' : '',
            isset($important) ? 'alert-important' : '',
        ])
        ->except(['variant', 'icon', 'close', 'important']);
@endphp

<div {{ $attributes }} role="alert">
    <div class="d-flex">
        @isset($icon)
            <i class="{{ $icon }} fs-2 me-1"></i>
        @endisset
        <div>
            {{ $message ?? $slot }}
        </div>
    </div>
    @if (isset($close))
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    @endif
</div>



{{-- <div class="alert alert-important alert-danger alert-dismissible" role="alert">
    <div class="d-flex">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <circle cx="12" cy="12" r="9"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        </div>
        <div>Your account has been deleted and can't be restored.</div>
    </div>
    <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
</div> --}}
