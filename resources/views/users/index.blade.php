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
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

@endsection

@section('content')


    <div class="row">
        <div class="col-md-2 offset-md-10">
            <button type="button"
                    class="btn btn-inline btn-primary"
                    data-toggle="modal"
                    data-target="#create-user">
                Create New User
            </button>

            <div class="modal fade"
                 id="create-user"
                 tabindex="-1"
                 role="dialog"
                 aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                                <i class="font-icon-close-2"></i>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Create New User</h4>
                        <form id="form-signup_v1" name="form-signup_v1">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <span id="form_output"></span>
                                <div class="form-group">
                                    <label class="form-label" for="signup_v1-username">Username</label>
                                    <div class="form-control-wrapper">
                                        <input id="signup_v1-username"
                                               class="form-control"
                                               name="username"
                                               type="text" data-validation="[L>=5, L<=18, MIXED]"
                                               data-validation-message="$ must be between 5 and 18 characters. No special characters allowed."
                                               data-validation-regex="/^((?!admin).)*$/i"
                                               data-validation-regex-message="The word &quot;Admin&quot; is not allowed in the $">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="signup_v1-email">Email</label>
                                    <div class="form-control-wrapper">
                                        <input id="signup_v1-email"
                                               class="form-control"
                                               name="email"
                                               type="text"
                                               data-validation="[EMAIL]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="signup_v1-password">Password</label>
                                    <div class="form-control-wrapper">
                                        <input id="signup_v1-password"
                                               class="form-control"
                                               name="password"
                                               type="password" data-validation="[L>=6]"
                                               data-validation-message="$ must be at least 6 characters">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="signup_v1-password-confirm">Confirm Password</label>
                                    <div class="form-control-wrapper">
                                        <input id="signup_v1-password-confirm"
                                               class="form-control"
                                               name="password-confirm"
                                               type="password" data-validation="[V==password]"
                                               data-validation-message="$ does not match the password">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="save" class="btn btn-rounded btn-primary" >Save User</button>
                        </div>
                    </div>

                    </form>
                    </div>

            </div><!--.modal-->

        </div>

    </div>

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
    <script src="{{ asset('js/lib/html5-form-validation/jquery.validation.min.js') }}"></script>

            <script src="{{ asset('js/main.js') }}"></script>
            <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready( function () {
        table = $('#usertable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('api.users') }}",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection