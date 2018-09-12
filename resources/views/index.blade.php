@extends('layouts.layout')

    @section('pageTitle')

    Home

    @endsection

    @section('stylesheets')

        <link rel="stylesheet" href="{{ asset('css/lib/font-awesome/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/separate/pages/widgets.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @endsection

    @section('content')

        <div class="col-md-4">
            <section class="widget widget-simple-sm-fill">
                <div class="widget-simple-sm-icon">
                    <i class="font-icon font-icon-user"></i>
                </div>
                <div class="widget-simple-sm-fill-caption">{{ $user_count }} Users</div>
            </section>
        </div>

        <div class="col-md-4">
            <section class="widget widget-simple-sm-fill red">
                <div class="widget-simple-sm-icon">
                    <i class="font-icon font-icon-weather-umbrella"></i>
                </div>
                <div class="widget-simple-sm-fill-caption">{{ $product_count }} Products</div>
            </section>
        </div>

        <div class="col-md-4">
            <section class="widget widget-simple-sm-fill green">
                <div class="widget-simple-sm-icon">
                    <i class="font-icon font-icon-wallet"></i>
                </div>
                <div class="widget-simple-sm-fill-caption">{{ $customer_count }} Customers</div>
            </section>
        </div>


    @endsection


    @section('scripts')

        <script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/lib/tether/tether.min.js') }}"></script>
        <script src="{{ asset('js/lib/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>


    @endsection