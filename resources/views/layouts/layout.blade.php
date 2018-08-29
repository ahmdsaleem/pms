<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('pageTitle')</title>

    @include('includes.stylesheets')
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


@include('includes.scripts')
@yield('scripts')
</body>

</html>