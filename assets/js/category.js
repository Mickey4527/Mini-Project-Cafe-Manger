// คือการรอให้หน้าเว็บโหลดเสร็จก่อน จึงจะทำงาน
$(document).ready(function() {
    // ถ้ากดลบบัญชี ให้ยืนยันอีกครั้ง ส่งการลบด้วย ajax
    $('#Delete').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let id = button.data('id') // Extract info from data-* attributes
        $('#confirm').click(function(){
            $.ajax({
                url: '../global/product/cat.php',
                type: 'post',
                data: {Catdelete: id},
                beforeSend: function(){
                    button.attr('disabled',true);
                    $('#confirm').attr('disabled',true);
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
                },
            });
        });
    });


    // ถ้ากดแก้ไขบัญชี ให้ดึงข้อมูลมาแสดงใน modal

    $('[id^=Edit]').click(function(){
        let id = $(this).data('id');
        $.ajax({
            url: '../global/product/cat.php',
            type: 'post',
            data: {Catedit: id},
            beforeSend: function(){
                $('#loading').css('display', 'block');
                $('[id^=Edit]').attr('disabled',true);
            },
            success: function(response){
                $('#loading').css('display', 'none');
                $('#edit').html(response);
                //show modal
                $('#EditCategory').modal('show');
                $('[id^=Edit]').attr('disabled',false);
            },
        });
    });


    $('body').on('change', '.is-invalid', function(){
        $(this).removeClass('is-invalid');
        $(this).next().html('');
    });
    
    $(document).on('click', '#saveEditCat', function(event) { // When HTML DOM "click" event is invoked on element with ID "somebutton", execute the following function...
        event.preventDefault();

        let id = $('#edit-cat_id').val();
        let name = $('#edit-cat_name').val();
        let desc = $('#edit-cat_desc').val();
        let color = $('#edit-color').val();

        let formData = new FormData();
        formData.append('saveCatedit', 'edit');
        formData.append('id', id);
        formData.append('name', name);
        formData.append('desc', desc);
        formData.append('color', color);

        $.ajax({
            url: '../global/product/cat.php',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#loadingSub').addClass('spinner-border spinner-border-sm');
                $('#saveEditCat').attr('disabled', true);
            },
            success: function(response, status, xhr) {
                console.log(response);
                if(xhr.status == 200) {
                    $('#loadingSub').removeClass('spinner-border spinner-border-sm');
                    $('#saveEditCat').modal('hide');
                    $('#notify').html(response);
                    const toast = new bootstrap.Toast(document.querySelector('.toast'));
                    toast.show();
                    $('#table').css('opacity', '0.5');
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                    return false;
                }
            },

        });
    });
});

// search employee
$('#search').keyup(function(){
    let search = $('#search').val();
    $.ajax({
        url: '../global/product/cat.php',
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
