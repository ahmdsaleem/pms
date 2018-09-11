var UserController=(function () {
    var routes={
        base: "users/"
    };
    var table;

    return {

        loadUsersDataTable: function () {
            table = $('#usertable').DataTable({
                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": "api/users",
                "columns": [
                    {data: 'id', name: 'id', searchable:true},
                    {data: 'name', name: 'name',searchable:true},
                    {data: 'email', name: 'email',searchable:true},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        },

        createUser: function()
        {
            $('#form-signup_v1').validate({

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
                        required:true
                    }

                },
                messages: {
                    email: {
                        required: "Please provide your email",
                    },
                    password:{
                        required: "Password is Required",
                    }

                }

            });
            if($('#form-signup_v1').valid()) {
                var form_data = $('#form-signup_v1').serialize();
                var ajaxSetup = GlobalController.functions.ajaxSetup();
                $.when(ajaxSetup).done(function () {
                    var createUser = GlobalController.functions.ajaxPromise(form_data, routes.base, GlobalController.variables.methods.post);
                    $.when(createUser).done(function (data) {
                        $('#create-user').modal('hide');
                        $('#usertable').DataTable().ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '4000'
                        })
                    });
                    $.when(createUser).fail(function (data) {
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

        editUser: function(id)
        {

            var ajaxSetup = GlobalController.functions.ajaxSetup();
            $.when(ajaxSetup).done(function () {
                var editUser= GlobalController.functions.ajaxPromise("",routes.base + id,GlobalController.variables.methods.put);
                $.when(editUser).done(function (data) {
                    $('#edit-product-select').val(null).trigger('change');
                    var selectID= new Array();
                    for(var i=0;i<data.products.length;i++)
                    {
                        selectID[i]=data.products[i].id;
                    }
                    $('#edit-product-select').val(selectID).trigger('change');
                    $('#id').val(data.id);
                    $('#username').val(data.name);
                    $('#email').val(data.email);
                    $('#password').val(data.password);
                    $('#update-user-modal').modal('show');
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


        updateUser: function()
        {
            $('#update-user-form').validate({

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

            if($('#update-user-form').valid()) {
                var form_data = $('#update-user-form').serialize();
                var id = $('#id').val();
                var ajaxSetup = GlobalController.functions.ajaxSetup();
                $.when(ajaxSetup).done(function () {
                    var updateUser = GlobalController.functions.ajaxPromise(form_data, routes.base + id, GlobalController.variables.methods.patch);
                    $.when(updateUser).done(function (data) {
                        $('#update-user-modal').modal('hide');
                        $('#usertable').DataTable().ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '4000'
                        })
                    });
                    $.when(updateUser).fail(function (data) {
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

        deleteUser: function(id)
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
                    var deleteUser=GlobalController.functions.ajaxPromise("",routes.base+id,GlobalController.variables.methods.delete);
                    $.when(deleteUser).done(function (data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    });
                    $.when(deleteUser).fail(function (data) {
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
            $('#save').on('click',function(){
                event.preventDefault();
                UserController.createUser();
            });

            $('#update').on('click',function(){
                event.preventDefault();
                UserController.updateUser();
            });
            $('#assign-product-select').select2({
                theme: "classic"
            });
            $('#edit-product-select').select2({
                theme: "classic"
            });

        },


        init: function () {
            this.loadUsersDataTable();
            this.bindEvents();
        }

    }

})();

$(document).ready( function () {
    UserController.init();


});
