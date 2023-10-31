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
        data: {Proedit: id},
        beforeSend: function(){
            $('[id^=Edit]').attr('disabled',true);
            $('#loading').css('display', 'block');
        },
        success: function(response){
            $('#loading').css('display', 'none');
            $('#edit').html(response);
            //show modal
            $('#EditProduct').modal('show');
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