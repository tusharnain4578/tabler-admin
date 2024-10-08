<div class="modal fade" id="{{ $id }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog @isset($center) modal-dialog-centered @endisset">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 py-2">
                @isset($title)
                    <h5 class="modal-title">{{ $title }}</h5>
                @endisset
                @isset($closeButton)
                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                        <i class="material-icons-outlined">close</i>
                    </a>
                @endisset
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            @isset($footer)
                <div class="modal-footer border-top-0">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>
