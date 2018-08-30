@extends('layouts.layout')

    @section('pageTitle')

    Home

    @endsection

    @section('stylesheets')

        <link rel="stylesheet" href="{{ asset('css/lib/font-awesome/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @endsection

    @section('content')

    Content

    @endsection


    @section('scripts')

        <script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/lib/tether/tether.min.js') }}"></script>
        <script src="{{ asset('js/lib/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>


    @endsection