// คือการรอให้หน้าเว็บโหลดเสร็จก่อน จึงจะทำงาน
$(document).ready(function() {
    // ถ้ากดลบบัญชี ให้ยืนยันอีกครั้ง ส่งการลบด้วย ajax
    $('#Delete').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let id = button.data('id') // Extract info from data-* attributes
        $('#confirm').click(function(){
            $.ajax({
                url: '../global/product/product.php',
                type: 'post',
                data: {Prodelete: id},
                beforeSend: function(){
                    button.attr('disabled',true);
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
                },
            });
        });
    });

    // Add product
    $('#savePro').click(function() {
        let name = $('#add-product_name').val();
        let price = $('#add-product_price').val();
        let stock = $('#add-product_stock').val();
        let type = $('#add-product_type').val();
        let detail = $('#add-product_desc').val();
        let date = $('#add-date_added').val();
        let image = $('#add-product_img')[0].files[0];

        let formData = new FormData();
        formData.append('Proadd', 'add');
        formData.append('name', name);
        formData.append('price', price);
        formData.append('unit', stock);
        formData.append('category', type);
        formData.append('detail', detail);
        formData.append('date', date);
        formData.append('img', image);

        $.ajax({
            url: '../global/product/product.php',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#addPro').attr('disabled', true);
            },
            success: function(response, status, xhr) {
                if(xhr.status == 200) {
                    $('#AddProduct').modal('hide');
                    $('#notify').html(response);
                    const toast = new bootstrap.Toast(document.querySelector('.toast'));
                    toast.show();
                    $('#table').css('opacity', '0.5');
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
                console.log(response);
            },
            error: function(xhr, status, error) {
                if(xhr.status == 400) {
                    let error = JSON.parse(xhr.responseText);
                    if(error.type == 'img'){
                        $('#add-product_img').addClass('is-invalid');
                        $('#invalid_product_img').html(error.msg);
                    }
                    if(error.type == 'empty'){
                        $('#add-product_name').addClass('is-invalid');
                        $('#invalid_product_name').html(error.msg);
                        $('#add-product_price').addClass('is-invalid');
                        $('#invalid_product_price').html(error.msg);
                        $('#add-product_stock').addClass('is-invalid');
                        $('#invalid_product_stock').html(error.msg);
                    }
                }
            }
        });
    });

    // ถ้ากดแก้ไขบัญชี ให้ดึงข้อมูลมาแสดงใน modal
    $('[id^=Edit]').click(function(){
        let id = $(this).data('id');
        $.ajax({
            url: '../global/product/product.php',
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


    $('body').on('change', '.is-invalid', function(){
        $(this).removeClass('is-invalid');
        $(this).next().html('');
    });
    
    $(document).on('click', '#saveEditPro', function(event) { // When HTML DOM "click" event is invoked on element with ID "somebutton", execute the following function...
        event.preventDefault();

        let id = $('#edit-product_id').val();
        let name = $('#edit-product_name').val();
        let price = $('#edit-product_price').val();
        let stock = $('#edit-product_stock').val();
        let type = $('#edit-product_type').val();
        let detail = $('#edit-product_desc').val();
        let date = $('#edit-date_added').val();
        let image = $('#edit-product_img')[0].files[0];

        let formData = new FormData();
        formData.append('saveProedit', 'edit');
        formData.append('id', id);
        formData.append('name', name);
        formData.append('price', price);
        formData.append('unit', stock);
        formData.append('category', type);
        formData.append('detail', detail);
        formData.append('date', date);
        formData.append('img', image);

        $.ajax({
            url: '../global/product/product.php',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#saveEditPro').attr('disabled', true);
            },
            success: function(response, status, xhr) {
                if(xhr.status == 200) {
                    $('#saveEditPro').modal('hide');
                    $('#notify').html(response);
                    const toast = new bootstrap.Toast(document.querySelector('.toast'));
                    toast.show();
                    $('#table').css('opacity', '0.5');
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function(xhr, status, error) {
                if(xhr.status == 400) {
                    let error = JSON.parse(xhr.responseText);
                    if(error.type == 'img'){
                        $('#edit-product_img').addClass('is-invalid');
                        $('#invalid_product_img').html(error.msg);
                    }
                }
            }
        });
    });
});
