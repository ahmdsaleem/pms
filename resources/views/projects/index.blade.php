@extends('layouts.layout')

@section('pageTitle')

    Blank page

@endsection

@section('stylesheets')

    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap-table/bootstrap-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/separate/vendor/bootstrap-select/bootstrap-select.min.css') }}">
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

@endsection

@section('content')

    <div class="col-md-2 offset-md-10">
        <button type="button"
                class="btn btn-inline btn-primary"
                data-toggle="modal"
                data-target="#create-project-modal">
            Create New Project
        </button>

        <div class="modal fade"
             id="create-project-modal"
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
                        <h4 class="modal-title" id="myModalLabel">Create New Project</h4>
                        <form id="create-project-form" name="create-project-form">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <span id="form_output"></span>
                                <div class="form-group">
                                    <label class="form-label" for="project-name">Project Name</label>
                                    <div class="form-control-wrapper">
                                        <input id="project-name"
                                               class="form-control"
                                               name="name"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="assign-platform-select">Platform</label>
                                        <div class="form-control-wrapper">
                                            <select class="bootstrap-select form-control" id="assign-platform-select" name="platform">
                                                <option disabled selected value> Select a Platform </option>
                                                @foreach($platforms as $platform)
                                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label class="form-label" for="project-description">Description</label>
                                    <div class="form-control-wrapper">
                                        <textarea class="form-control" name="description" id="project-description" rows="8"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="project-save" class="btn btn-rounded btn-primary" >Save Project</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div><!--.modal-->

        </div>


        <div class="modal fade"
             id="update-project-modal"
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
                        <h4 class="modal-title" id="myModalLabel">Edit Project</h4>
                        <form id="update-project-form">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <span id="form_output"></span>
                                <div class="form-group">
                                    <div class="form-control-wrapper">
                                        <input id="update-project-id"
                                               class="form-control"
                                               name="id"
                                               type="text"
                                               readonly hidden>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="update-project-name">Project Name</label>
                                    <div class="form-control-wrapper">
                                        <input id="update-project-name"
                                               class="form-control"
                                               name="name"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="assign-platform-select">Platform</label>
                                    <div class="form-control-wrapper">
                                        <select class="bootstrap-select form-control" id="edit-platform-select" name="platform">
                                            @foreach($platforms as $platform)
                                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="update-project-description">Description</label>
                                    <div class="form-control-wrapper">
                                        <textarea class="form-control" name="description" id="update-project-description" rows="8"></textarea>
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="update-project" class="btn btn-rounded btn-primary" >Save Project</button>
                            </div>
                        </form>
                    </div>


                </div>

            </div><!--.modal-->

        </div>


    </div>


    <div class="box-typical-body offset-md-1 col-md-9">
        <div class="table-responsive">
            <table class="table table-hover" id="projects-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Platform</th>
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
    <script src="{{ asset('js/lib/html5-form-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/projects/crud.js') }}"></script>
@endsection