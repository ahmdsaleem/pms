var ProjectController=(function () {
    var routes={
        base: "projects/",
        platform_fields:"projects/platform/fields/"
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
                    {data: 'platform_assigned', name: 'platform_assigned',searchable:true},
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
                    },
                    platform : {
                        required: true
                    },


                },
                messages: {
                    name: {
                        required: "Please type Project Name",
                    },
                    platform:{
                        required: "Please Select the Platform"
                    }
                }
            });

            $('input[fieldname="dynamic-attr"]').each(function () {
                $(this).rules('add', {
                    required: true,
                    // another rule, etc.
                });
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
                    $('#update-project-id').val(data.id);
                    $('#edit-platform-select').val(data.platform_id).trigger('change');
                    $('#update-project-name').val(data.name);
                    $('#project-ipn-url').val(data.url);
                    $('#update-project-description').val(data.description);
                    $('#update-project-modal').modal('show');

                });
                $.when(editProject).fail(function (data) {
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


                },
                messages: {
                    email: {
                        required: "Please provide your email",
                    },

                }

            });


            $('input[fieldname="dynamic-attr-edit"]').each(function () {
                $(this).rules('add', {
                    required: true,
                    // another rule, etc.
                });
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

        renderFields: function(platform_id)
        {

            var ajaxSetup = GlobalController.functions.ajaxSetup();
            $.when(ajaxSetup).done(function () {
                var getFields= GlobalController.functions.ajaxPromise("",routes.platform_fields + platform_id,GlobalController.variables.methods.get);
                $.when(getFields).done(function (data) {
                    $('.dynamic-fields').remove();
                    for(var i=0;i<data.length;i++) {
                    $('#select-platform-form-group').after('' +
                        '<div class="form-group dynamic-fields">'+
                        '<label class="form-label">' + data[i].name + '</label>'+
                        '<div class="form-control-wrapper">' +
                        '<input class="form-control" fieldname="dynamic-attr" type="text" name="'+ data[i].input_name +'">'+
                        '</div> </div>'
                    );
                    }
                });
                $.when(getFields).fail(function (data) {

                });
            });
        },

        renderFieldswithValues: function(project_id,platform_id)
        {
            var ajaxSetup = GlobalController.functions.ajaxSetup();
            $.when(ajaxSetup).done(function () {
                var getFieldswithValues= GlobalController.functions.ajaxPromise("","projects/" + project_id + "/platform/" + platform_id,GlobalController.variables.methods.get);
                $.when(getFieldswithValues).done(function (data) {
                    $('.dynamic-fields-values').remove();
                    for(var i=0;i<data.fields.length;i++) {

                        $('#edit-platform-form-group').after('' +
                            '<div class="form-group dynamic-fields-values">'+
                            '<label class="form-label">' + data.fields[i].name + '</label>'+
                            '<div class="form-control-wrapper">' +
                            '<input class="form-control" type="text" fieldname="dynamic-attr-edit" name="'+ data.fields[i].input_name +'" value="'+data.values[i].field_value  +'">'+
                            '</div> </div>'
                        );
                    }
                });
                $.when(getFieldswithValues).fail(function (data) {

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

            $("#assign-platform-select").on("change", function() {
                var platform_id=$(this).val();
                ProjectController.renderFields(platform_id);
            });

            $("#edit-platform-select").on("change", function() {
                var platform_id=$(this).val();
                var project_id=$('#update-project-id').val();
                ProjectController.renderFieldswithValues(project_id,platform_id);
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
