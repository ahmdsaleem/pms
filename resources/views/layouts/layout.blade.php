<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle')</title>
    <link href="img/favicon.144x144.html" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="img/favicon.114x114.html" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="img/favicon.72x72.html" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="img/favicon.57x57.html" rel="apple-touch-icon" type="image/png">
    <link href="img/favicon.html" rel="icon" type="image/png">
    <link href="img/favicon-2.html" rel="shortcut icon">
    @yield('stylesheets')


</head>
<body class="with-side-menu">

@include('includes.header')
<div class="mobile-menu-left-overlay"></div>
@include('includes.nav')
<div class="page-content">
    <div class="container-fluid">
        @yield('content')
    </div><!--.container-fluid-->
</div><!--.page-content-->


<script src="{{ asset('js/global/globalController.js') }}"></script>
@yield('scripts')
</body>

</html>