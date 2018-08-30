@extends('layouts.layout')

@section('pageTitle')

    Users

@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap-table/bootstrap-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection

@section('content')

    <div class="box-typical-body offset-md-1 col-md-10">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>About</th>
                    <th>Role</th>
                    <th>Operations</th>
                    <th>Date Created</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="table-photo">
                        <img src="img/photo-64-1.jpg" alt="" data-toggle="tooltip" data-placement="bottom" title="Nicholas<br/>Barrett">
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>

                    <td class="color-blue-grey-lighter">{{ $user->profile->about }}</td>
                    <td>
                        {{ $user->role->name }}
                    </td>
                    <td>
                        <i class="operationicon glyphicon glyphicon-eye-open"></i>
                        <i class="operationicon glyphicon glyphicon-edit"></i>
                        @if(auth()->user()->id!=$user->id)
                        <i class="operationicon glyphicon glyphicon-trash"></i>
                        @endif
                    </td>
                    <td class="table-date">{{ $user->created_at->diffForHumans() }} <i class="font-icon font-icon-clock"></i></td>
                </tr>
                @endforeach
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

    <script src="{{ asset('js/app.js') }}"></script>


@endsection