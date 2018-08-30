@extends('layouts.layout')

@section('pageTitle')

    Create Users

@endsection

@section('stylesheets')


    <link rel="stylesheet" href="{{ asset('css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('content')
    <header class="section-header">
        <div class="tbl">
            <div class="tbl-row">
                <div class="tbl-cell">
                    <h3>Create New User</h3>

                </div>
            </div>
        </div>
    </header>

    <section class="offset-md-2 col-md-6 card">
        <div class="card-block">
            <div class="row">
    <div class="">
        <form id="form-signup_v1" name="form-signup_v1" method="POST">
            <div class="form-group">
                <label class="form-label" for="signup_v1-username">Username</label>
                <div class="form-control-wrapper">
                    <input id="signup_v1-username"
                           class="form-control"
                           name="signup_v1[username]"
                           type="text" data-validation="[L>=6, L<=18, MIXED]"
                           data-validation-message="$ must be between 6 and 18 characters. No special characters allowed."
                           data-validation-regex="/^((?!admin).)*$/i"
                           data-validation-regex-message="The word &quot;Admin&quot; is not allowed in the $">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="signup_v1-email">Email</label>
                <div class="form-control-wrapper">
                    <input id="signup_v1-email"
                           class="form-control"
                           name="signup_v1[email]"
                           type="text"
                           data-validation="[EMAIL]">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="signup_v1-password">Password</label>
                <div class="form-control-wrapper">
                    <input id="signup_v1-password"
                           class="form-control"
                           name="signup_v1[password]"
                           type="password" data-validation="[L>=6]"
                           data-validation-message="$ must be at least 6 characters">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="signup_v1-password-confirm">Confirm Password</label>
                <div class="form-control-wrapper">
                    <input id="signup_v1-password-confirm"
                           class="form-control"
                           name="signup_v1[password-confirm]"
                           type="password" data-validation="[V==signup_v1[password]]"
                           data-validation-message="$ does not match the password">
                </div>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn">Create User</button>
            </div>
        </form>
    </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')


    <script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/lib/tether/tether.min.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/lib/html5-form-validation/jquery.validation.min.js') }}"></script>
    <script>
        $(function() {
            /* ==========================================================================
             Validation
             ========================================================================== */

            $('#form-signin_v1').validate({
                submit: {
                    settings: {
                        inputContainer: '.form-group'
                    }
                }
            });

            $('#form-signin_v2').validate({
                submit: {
                    settings: {
                        inputContainer: '.form-group',
                        errorListClass: 'form-error-text-block',
                        display: 'block',
                        insertion: 'prepend'
                    }
                }
            });

            $('#form-signup_v1').validate({
                submit: {
                    settings: {
                        inputContainer: '.form-group',
                        errorListClass: 'form-tooltip-error'
                    }
                }
            });

            $('#form-signup_v2').validate({
                submit: {
                    settings: {
                        inputContainer: '.form-group',
                        errorListClass: 'form-tooltip-error'
                    }
                }
            });
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>

@endsection