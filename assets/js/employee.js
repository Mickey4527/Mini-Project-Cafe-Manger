// ถ้ากดลบบัญชี ให้ยืนยันอีกครั้ง ส่งการลบด้วย ajax
$('#Delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    $('#confirm').click(function(){
        $.ajax({
            url: '../global/employee/employee.php',
            type: 'post',
            data: {Empdelete: id},
            beforeSend: function(){
                button.attr('disabled',true);
                $('#confirm').attr('disabled',true);
                $('#cancel').attr('disabled',true);
                $('#loading').css('display', 'block');
            },
            success: function(response){
                //hide modal
                $('#Delete').modal('hide');
                //display toast
                $('#notify').html(response);
                const toast = new bootstrap.Toast(document.querySelector('.toast'));
                toast.show();
                $('#table').css('opacity', '0.5');
                //reload page after 2 sec
                setTimeout(function(){
                    window.location.reload();
                }, 2000);
                return false;
            }
        });
    });
});
$('[id^=Edit]').click(function(){
    let id = $(this).data('id');
    $.ajax({
        url: '../global/employee/employee.php',
        type: 'post',
        data: {Empedit: id},
        beforeSend: function(){
            $('[id^=Edit]').attr('disabled',true);
            $('#loading').css('display', 'block');
        },
        success: function(response){
            $('#loading').css('display', 'none');
            $('#edit').html(response);
            //show modal
            $('#EditUser').modal('show');
            $('[id^=Edit]').attr('disabled',false);
        },
    });
});

// search employee
$('#search').keyup(function(){
    let search = $('#search').val();
    $.ajax({
        url: '../global/employee/employee.php',
        type: 'post',
        data: {search: search},
        beforeSend: function(){
            $('#loading-search').css('display', 'block');
        },
        success: function(response){
            $('#loading-search').css('display', 'none');
            $('#table').html(response);
        }
    });
});

//edit employee save
$(document).on('click', '#saveEditUser', function(event) { // When HTML DOM "click" event is invoked on element with ID "somebutton", execute the following function...
    event.preventDefault();
    let id = $('#edit-user_id').val();
    let firstname = $('#edit-first_name').val();
    let lastname = $('#edit-last_name').val();
    let tele = $('#edit-telephone').val();

    let formData = new FormData();
    formData.append('saveEmpedit', 'edit');
    formData.append('id', id);
    formData.append('firstName', firstname);
    formData.append('lastName', lastname);
    formData.append('tele', tele);

    $.ajax({
        url: '../global/employee/employee.php',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(){
            $('#loadingSub').addClass('spinner-border spinner-border-sm');
            $('#saveEditUser').attr('disabled',true);
        },
        success: function(response){
            $('#loadingSub').removeClass('spinner-border spinner-border-sm');
            $('#edit').modal('hide');
            $('#notify').html(response);
            const toast = new bootstrap.Toast(document.querySelector('.toast'));
            toast.show();
            $('#table').css('opacity', '0.5');
            setTimeout(function(){
                window.location.reload();
            }, 2000);
        }
    });
});