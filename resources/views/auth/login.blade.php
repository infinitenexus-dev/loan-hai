<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') . '/' }}" data-template="vertical-menu-template">
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ config('constants.APP_NAME') }}</title>
    <meta name="description" content="" />
    <link rel="shortcut icon" href="Frontend/images/loanhai.png" type="image/x-icon">
	<link rel="icon" href="Frontend/images/loanhai.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/materialdesignicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <style>
        form .error:not(li):not(input) {
            font-size: 100%;
        }

        .btn-primary {
            background-color: #3C8D53;
            border-color: #3C8D53;
        }

        .btn-check:focus+.btn-primary,
        .btn-primary:focus,
        .btn-primary.focus {
            background-color: #3C8D53;
            border-color: #3C8D53;
        }

        .btn-primary:hover {
            background-color: #3C8D53 !important;
            border-color: #3C8D53 !important;
        }
    </style>
</head>
<body>
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card p-2">
                    <div class="app-brand justify-content-center mt-5">
                        <span class="app-brand-logo demo">
                            <img loading="prelaod" decoding="async" class="img-fluid" width="160"
                                src="Frontend/images/logo.png" alt="Loan Hai">
                        </span>
                    </div>
                    <div class="card-body mt-2">
                        <h4 class="mb-2 fw-semibold">Welcome to Loanhai 👋</h4>
                        @if (Session::has('error'))
                            <div class="alert alert-solid-danger d-flex align-items-center" role="alert">
                                <i class="mdi mdi-alert-circle-outline me-2"></i>
                                {{ session('error') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-solid-danger d-flex align-items-center" role="alert">
                                <i class="mdi mdi-alert-circle-outline me-2"></i>
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <form method="POST" id="admin-login-form" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="email" placeholder="Enter your email" name="email"
                                            value="{{ old('email') }}" autocomplete="email" autofocus />
                                        <label for="email">Email</label>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span id="email_error" class="mb-3"></span>
                            </div>
                            <div class="form-password-toggle mb-3">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" autocomplete="current-password" />
                                        <label for="password">Password</label>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="input-group-text cursor-pointer"><i
                                            class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }} />
                                    <label class="form-check-label" for="remember"> Remember Me </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.validator.addMethod("noSpace", function(value, element) {
                return /^\S+$/.test(value);
            }, "Email must not contain spaces.");

            $("#admin-login-form").validate({
                rules: {
                    email: {
                        required: true,
                        noSpace: true,
                        email: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter your email.",
                        email: "Please enter a valid email address."
                    },
                },
                errorPlacement: function(error, element) {
                    error.insertAfter($("#" + element.attr("name") + "_error"));
                },
                submitHandler: function(form) {
                    return true;
                }
            });
        });
        $(document).ready(function() {
            $("#email").on("input", function() {
                $(this).val($(this).val().toLowerCase());
            });
        });
    </script>
    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
</body>
</html>
