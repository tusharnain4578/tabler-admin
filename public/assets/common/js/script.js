function showValidationErrors(xhr) {
    if (xhr.status === 422) {
        const errors = xhr.responseJSON.errors;

        // Clear previous errors
        $(".form-control").removeClass("is-invalid");
        $(".invalid-feedback").remove();

        // Iterate through each error and display it
        $.each(errors, function (field, messages) {
            const element = $('[name="' + field + '"]');
            element.addClass("is-invalid"); // Add Bootstrap invalid class
            // Append the first error message to the invalid-feedback div
            element.next(".invalid-feedback").remove(); // Clear previous messages
            element.after(
                '<div class="invalid-feedback">' + messages[0] + "</div>"
            );
        });
    }
}

function ajaxForm(formSelector, options = {}) {
    $(formSelector).on("submit", function (e) {
        e.preventDefault();
        const form = $(this);
        if ($(formSelector).valid()) {
            let isSuccess = false;
            let redirectTo = null;
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: options.formData ?? new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function () {
                    disable_form(form);
                    options.beforeSend && options.beforeSend();
                },
                success: function (response) {
                    if (response.success) isSuccess = true;
                    if (options.responseRedirect && response.redirectTo) {
                        redirectTo = response.redirectTo;
                        redirect(redirectTo);
                        return;
                    }
                    options.handleToast &&
                        response.toast &&
                        toast.open(response.toast);
                    options.success && options.success(response);
                },
                error: function (xhr) {
                    showValidationErrors(xhr);
                    options.error && options.error(xhr);
                },
                complete: function () {
                    if (
                        !(
                            options.disableFormAfterSuccess &&
                            isSuccess &&
                            redirectTo
                        )
                    ) {
                        enable_form(form);
                    }
                    options.complete && options.complete();
                },
            });
        }
    });
}
function redirect(url) {
    window.location.href = url;
}

function disable_form(selector, isId = true) {
    const container = $(selector);
    container.find("input, select, textarea, button").prop("disabled", true);
    container.children().each(function () {
        disable_form($(this));
    });
}

function enable_form(selector) {
    const container = $(selector);
    container.find("input, select, textarea, button").prop("disabled", false);
    container.children().each(function () {
        enable_form($(this));
    });
}

function getCsrfToken() {
    const tokenMeta = document.getElementById("csrf");
    return tokenMeta ? tokenMeta.getAttribute("content") : null;
}

function debounce(func, wait) {
    let timeout;
    return function (...args) {
        const context = this;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), wait);
    };
}

function wrap_anchor(str, url, newTab = false) {
    return `<a href="${url}" ${newTab ? 'target="_blank"' : ""}>${str}</a>`;
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
        },
    });

    // applying trim on values before jquery validation
    $.each($.validator.methods, function (key, value) {
        $.validator.methods[key] = function () {
            if (arguments.length > 0) {
                arguments[0] = $.trim(arguments[0]);
            }
            return value.apply(this, arguments);
        };
    });
});
