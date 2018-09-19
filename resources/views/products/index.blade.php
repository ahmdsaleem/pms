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
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

@endsection

@section('content')

    <div class="col-md-2 offset-md-10">
        <button type="button"
                class="btn btn-inline btn-primary"
                data-toggle="modal"
                data-target="#create-product-modal">
            Create New Product
        </button>

        <div class="modal fade"
             id="create-product-modal"
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
                        <h4 class="modal-title" id="myModalLabel">Create New Product</h4>
                        <form id="create-product-form" name="create-product-form">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <span id="form_output"></span>
                                <div class="form-group">
                                    <label class="form-label" for="product-name">Product Name</label>
                                    <div class="form-control-wrapper">
                                        <input id="product-name"
                                               class="form-control"
                                               name="name"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="product-description">Description</label>
                                    <div class="form-control-wrapper">
                                        <textarea class="form-control" name="description" id="product-description" rows="8"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="product-save" class="btn btn-rounded btn-primary" >Save Product</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div><!--.modal-->

        </div>


        <div class="modal fade"
             id="update-product-modal"
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
                        <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                        <form id="update-product-form">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <span id="form_output"></span>
                                <div class="form-group">
                                    <div class="form-control-wrapper">
                                        <input id="update-product-id"
                                               class="form-control"
                                               name="id"
                                               type="text"
                                               readonly hidden>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="update-product-name">Product Name</label>
                                    <div class="form-control-wrapper">
                                        <input id="update-product-name"
                                               class="form-control"
                                               name="name"
                                               type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="update-product-description">Description</label>
                                    <div class="form-control-wrapper">
                                        <textarea class="form-control" name="description" id="update-product-description" rows="8"></textarea>
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="update-product" class="btn btn-rounded btn-primary" >Save Product</button>
                            </div>
                        </form>
                    </div>


                </div>

            </div><!--.modal-->

        </div>


    </div>


    <div class="box-typical-body offset-md-1 col-md-8">
        <div class="table-responsive">
            <table class="table table-hover" id="products-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
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
    <script src="{{ asset('js/products/crud.js') }}"></script>
@endsection