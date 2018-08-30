@extends('layouts.layout')

@section('pageTitle')

    Blank page

@endsection

@section('stylesheets')
    <link href="img/favicon.144x144.html" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="img/favicon.114x114.html" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="img/favicon.72x72.html" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="img/favicon.57x57.html" rel="apple-touch-icon" type="image/png">
    <link href="img/favicon.html" rel="icon" type="image/png">
    <link href="img/favicon-2.html" rel="shortcut icon">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

@endsection

@section('content')

    Content

@endsection


@section('scripts')

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/tether/tether.min.js"></script>
    <script src="js/lib/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>

    <script src="js/lib/html5-form-validation/jquery.validation.min.js"></script>
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

    <script src="js/app.js"></script>


@endsection