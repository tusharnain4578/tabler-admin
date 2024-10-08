@pushOnce('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.min.css">
    <style>
        div.dt-container .dt-paging .dt-paging-button:hover {
            border: none;
            background: inherit;
        }

        div.dt-container .dt-paging .dt-paging-button:active {
            box-shadow: inherit;
        }

        div.dt-container .dt-paging .dt-paging-button {
            border: none;
            margin: 0;
            padding: 0;
        }

        @media screen and (max-width: 767px) {

            div.dt-container div.dt-length,
            div.dt-container div.dt-search,
            div.dt-container div.dt-info,
            div.dt-container div.dt-paging {
                margin-bottom: 10px;
            }
        }

        td,
        th {
            vertical-align: middle;
        }
    </style>
@endpushOnce

@pushOnce('script')
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
@endpushOnce
