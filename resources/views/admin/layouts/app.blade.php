@php
    $previousUrl = url()->previous();
    if (!isset($buttons)) {
        $buttons = [];
    }
@endphp

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="_token" content="{{ csrf_token() }}" id="csrf">
    <title>{{ $title ?? 'Dashboard' }} | Dashboard | Office MS</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/admin/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/style.css') }}">

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .page-wrapper .page-header {
            margin-top: 10px;
        }

        .cursor-pointer {
            cursor: pointer !important;
        }

        .fit-content {
            width: fit-content !important;
        }

        table th,
        table td {
            text-align: start !important;
        }
    </style>

    @stack('style')
</head>


<body class="layout-fluid">

    <script src="{{ asset('assets/admin/js/demo-theme.min.js') }}"></script>

    <div class="page">

        @include('admin.layouts.components.sidebar')

        @include('admin.layouts.components.header')

        <div class="page-wrapper">

            <div class="page-header d-print-none">
                <div class="container-xl">

                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="d-flex align-items-center">
                                @if ($previousUrl !== route('admin.auth.login'))
                                    <a href="{{ $previousUrl }}" class="me-2">
                                        <i class="ti ti-arrow-left me-1 text-white bg-primary p-3 rounded-circle"></i>
                                    </a>
                                @endif
                                <div>
                                    {!! $breadcrumbs ?? '' !!}
                                    @isset($pageTitle)
                                        <h2 class="page-title mt-2">
                                            {{ $pageTitle }}
                                        </h2>
                                    @endisset
                                </div>
                            </div>
                        </div>

                        @if (count($buttons) > 0)
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    @foreach ($buttons as $button)
                                        @if (!is_null($button))
                                            <div>
                                                <a href="{{ $button['url'] ?? 'javascript:;' }}"
                                                    class="d-none d-sm-inline-block">
                                                    <button class="btn btn-primary ">
                                                        @isset($button['icon'])
                                                            <i class="{{ $button['icon'] }} me-2"></i>
                                                        @endisset
                                                        {{ $button['label'] }}
                                                    </button>
                                                </a>
                                                @if (isset($button['icon']))
                                                    <a href="{{ $button['url'] ?? 'javascript:;' }}"
                                                        class="btn btn-primary d-sm-none btn-icon"
                                                        aria-label="{{ $button['label'] }}">
                                                        <i class="{{ $button['icon'] }}"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>


            @include('admin.layouts.components.footer')

            <form style="display: hidden;" action="{{ route('admin.auth.handle-logout') }}" method="POST"
                id="logoutPost">
                @csrf
            </form>
        </div>
    </div>


    <script type="text/javascript" src="{{ asset('assets/admin/js/tabler.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('assets/common/plugins/jquery/jquery.min.js') }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>


    <script type="text/javascript" src="{{ asset('assets/common/plugins/notyf/notyf.min.js') }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('assets/common/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/script.js') }}"></script>

    @stack('script')
    @include('admin.layouts.components.flash')
    <script>
        $(document).ready(function() {
            $('.dt-search input').attr('placeholder', 'Search...')
        });
    </script>
</body>

</html>
