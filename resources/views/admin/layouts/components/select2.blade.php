@pushOnce('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endPushOnce


@pushOnce('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2({
            theme: "bootstrap-5",
        });
        $('.select2').each(function() {
            const selectElement = $(this);
            const select2Container = selectElement.next(".select2-container");
            selectElement.insertAfter(select2Container);
        });
    </script>
@endPushOnce
