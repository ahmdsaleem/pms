var table;
function loadUsersDataTable() {
    table = $('#usertable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "api/users",
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
}


function createUser()
{

    $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
    })
    var form_data = $('#form-signup_v1').serialize();
    $.ajax({
        url:"users",
        method:"POST",
        data:form_data,
        dataType:"json",
        success:function(data)
        {
            $('#create-user').modal('hide');
            $('#usertable').DataTable().ajax.reload();
            swal({
                title: 'Success!',
                text: data.message,
                type: 'success',
                timer: '4000'
            })
        }
    })
}


function deleteUser(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then(function () {

        $.ajax({
            url : "users/"+id,
            type : "DELETE",
            dataType: "JSON",
            data: {
                "id": id // method and token not needed in data
            },
            success : function(data) {
                table.ajax.reload();
                swal({
                    title: 'Success!',
                    text: data.message,
                    type: 'success',
                    timer: '1500'
                })
            },
            error : function () {
                swal({
                    title: 'Oops...',
                    text: data.message,
                    type: 'error',
                    timer: '1500'
                });
            }
        });
    });
}


function editUser(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "users/" + id,
        type: "PUT",
        dataType: "JSON",
        data: {
            "id": id // method and token not needed in data
        },
        success: function(data) {
            $('#update-user-modal').modal('show');
            $('#id').val(data.id);
            $('#username').val(data.name);
            $('#email').val(data.email);
            $('#password').val(data.password);
        },
        error : function() {
            alert("Nothing Data");
        }
    });
}


function userUpdate()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var form_data = $('#update-user-form').serialize();
    var id=$('#id').val();
    $.ajax({
        url:"users/"+id,
        method:"PATCH",
        data:form_data,
        dataType:"json",
        success:function(data)
        {
            $('#update-user-modal').modal('hide');
            $('#usertable').DataTable().ajax.reload();
            swal({
                title: 'Success!',
                text: data.message,
                type: 'success',
                timer: '4000'
            })
        }
    })
}


$(document).ready( function () {

    // UserController.init();
    loadUsersDataTable();

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


    $('#save').on('click',function(){
        event.preventDefault();
        if($('#form-signup_v1').valid())
        {
            createUser();
        }


    });



    $('#update').on('click',function(){
        event.preventDefault();
        if($('#update-user-form').valid()) {
            userUpdate();
        }
    });
});