$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*  When user click add user button */
    $('body').on('click', '#create-new-user', function () {
        $('#btn-save').val("create-user");
        $('#userForm').trigger("reset");
        $('#userCrudModal').text("Add New User");
        $('#ajax-crud-modal').modal('show');
    });

    /* When click edit user */
    $('body').on('click', '#edit-user', function () {
        var user_id = $(this).data('id');

        $('#userCrudModal').text("Edit User");
        $('#btn-save').val("edit-user");
        $('#ajax-crud-modal').modal('show');

        $.get('ajax-crud/'+ user_id +'/edit', function (data) {
            $('#user_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
        })
    });


    //delete user login
    $('body').on('click', '#delete-user', function () {
        $('#id_delete').val($(this).data('id'));
        $('#ajax-delete-modal').modal('show');
    });
    $('#ajax-delete-modal').on('click', '#btn-confirm', function() {
        $.ajax({
            type: "DELETE",
            url: "ajax-crud/" + $('#id_delete').val(),
            success: function (data) {
                $("#user_id_" + $('#id_delete').val()).remove();
                reindex();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    function reindex(){
        $('.col1').each(function (editIndexNotes) {
            $(this).html(++editIndexNotes);
        })
    }

    if ($("#userForm").length > 0) {
        $("#userForm").validate({

            submitHandler: function(form) {
                var actionType = $('#btn-save').val();
                $('#btn-save').text('Sending..');

                $.ajax({
                    data: $('#userForm').serialize(),
                    url: "ajax-crud",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        var user = '<tr id="user_id_' + data.id + '"><th class="col1"></th><td>' + data.name + '</td><td>' + data.email + '</td>';
                            user += '<td><div class="btn-group" role="group" aria-label="Action">';
                            user += '<button type="button" id="edit-user" data-id="' + data.id + '" class="btn btn-info"><i class="fa fa-edit"></i></button>';
                            user += '<button type="button" id="delete-user" data-id="' + data.id + '" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                            user +='</div></td></tr>';

                        if (actionType == "create-user") {
                            $('#users-crud').prepend(user);
                        } else {
                            $("#user_id_" + data.id).replaceWith(user);
                        }
                        reindex();
                        $('#userForm').trigger("reset");
                        $('#ajax-crud-modal').modal('hide');
                        $('#btn-save').text('Save Changes');

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#btn-save').text('Save Changes');
                    }
                });
            }
        });
    }
});

