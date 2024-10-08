$(document).ready(function () {
    $(document).on("show.bs.modal", function () {
        $(".page-content").addClass("modal-bg-blur");
    });

    // Listen for when any modal is hidden
    $(document).on("hidden.bs.modal", function () {
        $(".page-content").removeClass("modal-bg-blur");
    });

    $(".toggle_show_password_input").each(function () {
        $(this)
            .siblings("a")
            .on("click", function (e) {
                e.preventDefault();
                const inputField = $(this).siblings(
                    ".toggle_show_password_input"
                );

                if (inputField.attr("type") == "text") {
                    inputField.attr("type", "password");
                    $(this).find("i").addClass("bi-eye-slash-fill");
                    $(this).find("i").removeClass("bi-eye-fill");
                } else {
                    inputField.attr("type", "text");
                    $(this).find("i").removeClass("bi-eye-slash-fill");
                    $(this).find("i").addClass("bi-eye-fill");
                }
            });
    });
});
