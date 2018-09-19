var ProjectController=(function () {
    var routes={
        base: "projects/"
    };
    var table;

    return {

        loadProjectsDataTable: function () {
            table = $('#projects-table').DataTable({
                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": "api/projects",
                "columns": [
                    {data: 'id', name: 'id', searchable:true},
                    {data: 'name', name: 'name',searchable:true},
                    {data: 'description', name: 'description',searchable:true},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        },

        createProject: function()
        {
            $('#create-project-form').validate({

                rules: {
                    name: {
                        required: true,
                        minlength:5,
                    }
                },
                messages: {
                    name: {
                        required: "Please type Project Name",
                    }
                }
            });
            if($('#create-project-form').valid()) {
                var form_data = $('#create-project-form').serialize();
                var ajaxSetup = GlobalController.functions.ajaxSetup();
                $.when(ajaxSetup).done(function () {
                    var createProject = GlobalController.functions.ajaxPromise(form_data, routes.base, GlobalController.variables.methods.post);
                    $.when(createProject).done(function (data) {
                        $('#create-project-modal').modal('hide');
                        $('#projects-table').DataTable().ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '4000'
                        })
                    });
                    $.when(createProject).fail(function (data) {
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


        editProject: function(id)
        {
            var ajaxSetup = GlobalController.functions.ajaxSetup();
            $.when(ajaxSetup).done(function () {
                var editProject= GlobalController.functions.ajaxPromise("",routes.base + id,GlobalController.variables.methods.put);
                $.when(editProject).done(function (data) {
                    $('#update-project-modal').modal('show');
                    $('#update-project-id').val(data.id);
                    $('#update-project-name').val(data.name);
                    $('#update-project-description').val(data.description);
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



        updateProject: function()
        {
            $('#update-project-form').validate({

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

            if($('#update-project-form').valid()) {
                var form_data = $('#update-project-form').serialize();
                var id = $('#update-project-id').val();
                var ajaxSetup = GlobalController.functions.ajaxSetup();
                $.when(ajaxSetup).done(function () {
                    var updateProject = GlobalController.functions.ajaxPromise(form_data, routes.base + id, GlobalController.variables.methods.patch);
                    $.when(updateProject).done(function (data) {
                        $('#update-project-modal').modal('hide');
                        $('#projects-table').DataTable().ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '4000'
                        })
                    });
                    $.when(updateProject).fail(function (data) {
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


        deleteProject: function(id)
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
                    var deleteProject=GlobalController.functions.ajaxPromise("",routes.base+id,GlobalController.variables.methods.delete);
                    $.when(deleteProject).done(function (data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    });
                    $.when(deleteProject).fail(function (data) {
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
            $('#project-save').on('click',function(){
                event.preventDefault();
                ProjectController.createProject();
            });

            $('#update-project').on('click',function(){
                event.preventDefault();
                ProjectController.updateProject();
            });

        },


        init: function () {
            this.loadProjectsDataTable();
            this.bindEvents();
        }

    }

})();

$(document).ready( function () {
    ProjectController.init();
});
