@extends('layouts.layout')

@section('pageTitle')

    Customers

@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap-table/bootstrap-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('css/separate/vendor/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/separate/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/separate/vendor/bootstrap-daterangepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

    <div class="row">
            <h4>Apply Filters</h4>
        <form id="products-filter-form" action="{{ route('customer.filter') }}" method="GET">
            <div class="form-group">
                <div class="col-md-4">
                <div class='input-group date'>
                    <input id="daterange" name="daterange" type="text" value="01/01/2015 1:30 PM - 01/01/2018 2:00 PM" class="form-control">
                    <span class="input-group-addon">
                        <i class="font-icon font-icon-calend"></i>
                    </span>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="offset-md-2 col-md-4">
                    <select id="products-filter" name="products[]" multiple="multiple">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="form-group">
                <div class="col-md-1">
                <button type="submit" class="btn btn-success"><i class="font-icon font-icon-refresh"></i> Sync</button>
                </div>

            </div>
        </form>
    </div>

    <br>
    <br>

    <div class="row">
        <div class="box-typical-body offset-md-1 col-md-8">
            <div class="table-responsive">
                <table class="table table-hover" id="customers-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Products Assigned</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        @endsection


        @section('scripts')

            <script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('js/lib/tether/tether.min.js') }}"></script>
            <script src="{{ asset('js/lib/bootstrap/bootstrap.min.js') }}"></script>
            <script src="{{ asset('js/plugins.js') }}"></script>
            <script src="{{ asset('js/lib/peity/jquery.peity.min.js') }}"></script>
            <script src="{{ asset('js/lib/table-edit/jquery.tabledit.min.js') }}"></script>
            <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
            <script src="{{ asset('js/lib/html5-form-validation/jquery.validate.min.js') }}"></script>
            <script src="{{ asset('js/lib/bootstrap-multiselect.js') }}"></script>
            <script src="{{ asset('js/app.js') }}"></script>
            <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
            <script src="{{ asset('js/lib/select2/select2.full.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/lib/moment/moment-with-locales.min.js') }}"></script>
            <script src="{{ asset('js/lib/daterangepicker/daterangepicker.js') }}"></script>
            <script src="{{ asset('js/customers/crud.js') }}"></script>

@endsection