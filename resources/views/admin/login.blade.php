<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        Log In | LMLM
    </title>
    <!-- CSS files -->
    <link href="{{ asset('assets/admin/css/tabler.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="{{ asset('assets/admin/js/demo-theme.min.js') }}"></script>
    <div class="row g-0 flex-fill">
        <div class="col-12 col-lg-6 col-xl-4 d-flex flex-column justify-content-center">
            <div class="container container-tight my-5 px-lg-5">
                <div class="text-center mb-4">
                    <a href="." class="navbar-brand navbar-brand-autodark"><img
                            src="{{ asset('static/logo.svg') }}" height="36" alt=""></a>
                </div>
                <h2 class="h3 text-center mb-3">
                    Login to your account
                </h2>

                @error('login_failed')
                    <x-admin.alert variant='danger' icon='ti ti-exclamation-circle' :message='$message' />
                @enderror

                <form action="{{ route('admin.auth.handle-login') }}" method="POST" id="login-form" autocomplete="off"
                    novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="test" name="username" class="form-control" placeholder="Enter username"
                            autocomplete="off">

                    </div>
                    <div class="mb-2">
                        <label class="form-label">
                            Password
                        </label>
                        <input name="password" type="password" class="form-control is-invalid"
                            placeholder="Your password" autocomplete="off">
                    </div>
                    <div class="mt-4">
                        <label class="form-check">
                            <input name="remember" type="checkbox" class="form-check-input" />
                            <span class="form-check-label">Remember me on this device</span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            Sign in
                        </button>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
            <!-- Photo -->
            <div class="bg-cover h-100 min-vh-100"
                style="background-image: url({{ asset('static/photos/finances-us-dollars-and-bitcoins-currency-money-2.jpg') }})">
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('assets/admin/js/tabler.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('assets/common/plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/common/js/script.js') }}"></script>


    {!! JsValidator::formRequest(\App\Http\Requests\Admin\Auth\LoginRequest::class, '#login-form') !!}

    <script>
        $(document).ready(function() {
            var validator = $('#login-form');
            $('#login-form').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                if (validator.valid()) {
                    let loggedIn = false;
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        beforeSend: function() {
                            disable_form(form);
                        },
                        success: function(response) {
                            if (response.success && response.data.redirect) {
                                loggedIn = true;
                                redirect(response.data.redirect);
                            }
                        },
                        error: function(xhr) {
                            showValidationErrors(xhr);
                        },
                        complete: function() {
                            if (!loggedIn) {
                                enable_form(form);
                            }
                        }
                    });
                }
            });

        });
    </script>

</body>

</html>
