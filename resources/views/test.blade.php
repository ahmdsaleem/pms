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
    <form action="/getrequest" method="GET">
        <input class="form-control" type="text" name="name" >
        <input class="form-control" type="text" name="email" >
        <button class="btn-success" type="submit">Submit</button>
        </form>
    </div>


@endsection


@section('scripts')

    <script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/lib/tether/tether.min.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>


@endsection