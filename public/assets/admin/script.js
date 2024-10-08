const toast = new Notyf({
    duration: 5000,
    types: [
        {
            type: "warning",
            background: "orange",
            icon: {
                className: "ti ti-alert-circle fs-2 text-white",
                tagName: "i",
                text: "warning",
            },
        },
        {
            type: "primary",
            background: "#0054a6",
            icon: {
                className: "ti ti-info-circle fs-2 text-white",
                tagName: "i",
                text: "info",
            },
        },
    ],
});
// how to use
// toast.open({ type: "success", message: "hello world" });

async function askConfirmation(options = {}) {
    const {
        title = "Are you sure?",
        message = "If you proceed, you won't be able to revert this.",
        confirmButtonText = "Yes, delete it",
        processingText = "Processing",
        variant = "danger",
        onConfirm = null, // callback
        icon = "ti ti-alert-triangle",
    } = options;

    $("#modal-confirmation").modal("hide");

    $("#modal-confirmation .modal-title").html(title);
    $("#modal-confirmation .modal-message").html(message);
    const confirmButton = $("#modal-confirmation .confirm-btn");
    const mainIcon = $("#modal-confirmation .main-icon");
    const modalStatus = $("#modal-confirmation .modal-status");
    confirmButton.off("click");
    confirmButton.find(".spinner-border").hide();
    confirmButton.removeClass().addClass("btn confirm-btn btn-" + variant);
    mainIcon.removeClass().addClass(`main-icon ${icon} text-${variant}`);
    modalStatus.removeClass().addClass("modal-status bg-" + variant);
    $("#modal-confirmation .confirm-btn .btn-text").text(confirmButtonText);

    confirmButton.on("click", async function () {
        confirmButton.find(".spinner-border").show();
        confirmButton.prop("disabled", true);
        confirmButton.find(".btn-text").text(processingText);
        onConfirm && (await onConfirm());
        confirmButton.find(".btn-text").text(confirmButtonText);
        confirmButton.prop("disabled", false);
        confirmButton.find(".spinner-border").hide();
        $("#modal-confirmation").modal("hide");
    });

    $("#modal-confirmation").modal("show");
}

$(document).ready(function () {
    $(
        "body"
    ).append(`<div class="modal modal-blur fade" id="modal-confirmation" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-status"></div>
                <div class="modal-body text-center py-4">
                    <i class="main-icon" style="font-size: 60px;"></i>
                    <div class="modal-title mt-3"></div>
                    <div class="modal-message"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">Cancel</button>
                    <button style="min-width: 160px;" role="button" type="button" class="confirm-btn">
                        <span style="display: none;" class="spinner-border spinner-border-sm me-2"
                            role="status"></span>
                        <span class="btn-text"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>`);
});
