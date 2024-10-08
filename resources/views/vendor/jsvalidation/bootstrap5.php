<script>
    jQuery(document).ready(function () {

        $("<?= $validator['selector']; ?>").each(function () {
            $(this).validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',

                errorPlacement: function (error, element) {
                    error.appendTo(element.parent());
                },
                highlight: function (element) {
                    $(element).removeClass('is-valid').addClass('is-invalid'); // add the Bootstrap error class to the control group

                    const inputGroupText = $(element).parent().find('.input-group-text');
                    inputGroupText.addClass('border-danger'); 

                },

                <?php if (isset($validator['ignore']) && is_string($validator['ignore'])): ?>

                    ignore: "<?= $validator['ignore']; ?>",
                <?php endif; ?>


                unhighlight: function (element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');

                    const inputGroupText = $(element).parent().find('.input-group-text');
                    inputGroupText.removeClass('border-danger'); 
                },

                success: function (element) {
                    $(element).removeClass('is-invalid').addClass('is-valid'); // remove the Boostrap error class from the control group

                    const inputGroupText = $(element).parent().find('.input-group-text');
                    inputGroupText.remove('border-danger').addClass('border-success'); 
                },

                focusInvalid: true,
                <?php if (Config::get('jsvalidation.focus_on_error')): ?>
                    invalidHandler: function (form, validator) {

                        if (!validator.numberOfInvalids())
                            return;

                        $('html, body').animate({
                            scrollTop: $(validator.errorList[0].element).offset().top
                        }, <?= Config::get('jsvalidation.duration_animate') ?>);

                    },
                <?php endif; ?>

                rules: <?= json_encode($validator['rules']); ?>
            });
        });
    });
</script>