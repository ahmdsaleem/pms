var ProductController=(function () {
    var routes={
        base: "products/"
    };
    var table;

    return {

        loadProductsDataTable: function () {
            table = $('#products-table').DataTable({
                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": "api/products",
                "columns": [
                    {data: 'id', name: 'id', searchable:true},
                    {data: 'name', name: 'name',searchable:true},
                    {data: 'description', name: 'description',searchable:true},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        },

        createProduct: function()
        {
            $('#create-product-form').validate({

                rules: {
                    name: {
                        required: true,
                        minlength:5,
                    }
                },
                messages: {
                    name: {
                        required: "Please type Product Name",
                    }
                }
            });
            if($('#create-product-form').valid()) {
                var form_data = $('#create-product-form').serialize();
                var ajaxSetup = GlobalController.functions.ajaxSetup();
                $.when(ajaxSetup).done(function () {
                    var createProduct = GlobalController.functions.ajaxPromise(form_data, routes.base, GlobalController.variables.methods.post);
                    $.when(createProduct).done(function (data) {
                        $('#create-product-modal').modal('hide');
                        $('#products-table').DataTable().ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '4000'
                        })
                    });
                    $.when(createProduct).fail(function (data) {
                        swal({
                            title: 'Error!'.data.code,
                            text: data.message,
                            type: 'error',
                            timer: '4000'
                        });
                    })
                });
            }
        },


        editProduct: function(id)
        {
            var ajaxSetup = GlobalController.functions.ajaxSetup();
            $.when(ajaxSetup).done(function () {
                var editProduct= GlobalController.functions.ajaxPromise("",routes.base + id,GlobalController.variables.methods.put);
                $.when(editProduct).done(function (data) {
                    $('#update-product-modal').modal('show');
                    $('#update-product-id').val(data.id);
                    $('#update-product-name').val(data.name);
                    $('#update-product-description').val(data.description);
                });
                $.when(editUser).fail(function (data) {
                    swal({
                        title: 'Oops...',
                        text: 'Error Occurred',
                        type: 'error',
                        timer: '1500'
                    });
                });
            });
        },



        updateProduct: function()
        {
            $('#update-product-form').validate({

                rules: {
                    username: {
                        required: true,
                        minlength:5,

                    },
                    email: {
                        required: true,
                        email: true
                    },

                    password:{

                    }

                },
                messages: {
                    email: {
                        required: "Please provide your email",
                    },

                }

            });

            if($('#update-product-form').valid()) {
                var form_data = $('#update-product-form').serialize();
                var id = $('#update-product-id').val();
                var ajaxSetup = GlobalController.functions.ajaxSetup();
                $.when(ajaxSetup).done(function () {
                    var updateProduct = GlobalController.functions.ajaxPromise(form_data, routes.base + id, GlobalController.variables.methods.patch);
                    $.when(updateProduct).done(function (data) {
                        $('#update-product-modal').modal('hide');
                        $('#products-table').DataTable().ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '4000'
                        })
                    });
                    $.when(updateProduct).fail(function (data) {
                        swal({
                            title: 'Error'.data.code,
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        });
                    });
                });
            }
        },


        deleteProduct: function(id)
        {
            var ajaxSetup = GlobalController.functions.ajaxSetup();
            $.when(ajaxSetup).done(function () {
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then(function () {
                    var deleteProduct=GlobalController.functions.ajaxPromise("",routes.base+id,GlobalController.variables.methods.delete);
                    $.when(deleteProduct).done(function (data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    });
                    $.when(deleteProduct).fail(function (data) {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        });

                    });
                });
            });
        },



        bindEvents: function()
        {
            $('#product-save').on('click',function(){
                event.preventDefault();
                ProductController.createProduct();
            });

            $('#update-product').on('click',function(){
                event.preventDefault();
                ProductController.updateProduct();
            });

        },


        init: function () {
            this.loadProductsDataTable();
            this.bindEvents();
        }

    }

})();

$(document).ready( function () {
    ProductController.init();
});
