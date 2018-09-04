@extends('layouts.layout')

@section('pageTitle')

    Users

@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap-table/bootstrap-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection

@section('content')

    <div class="box-typical-body offset-md-1 col-md-8">
        <div class="table-responsive">
            <table class="table table-hover" id="usertable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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
    <script>
        $(document).ready( function () {
            $('#usertable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('api.users') }}",
                "columns": [
                    {"data": "id"},
                    { "data": "name" },
                    { "data": "email" }
                ]
            });
        });
    </script>

    <script src="{{ asset('js/app.js') }}"></script>


@endsection