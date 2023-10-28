// ถ้ากดลบบัญชี ให้ยืนยันอีกครั้ง ส่งการลบด้วย ajax
$('#Delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
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

$('#addPro').click(function(){
    var name = $('#product_name').val();
    var price = $('#product_price').val();
    var stock = $('#product_stock').val();
    var type = $('#product_type').val();
    var detail = $('#product_detail').val();
    var image = $('#product_image').val();

    $.ajax({
        url: '../global/product/product.php',
        type: 'post',
        data: {
            Proadd: 'add',
            name: name,
            price: price,
            unit: stock,
            category: type,
            detail: detail,
            image: image,
        },
        beforeSend: function(){
            $('#addPro').attr('disabled',true);
        },
        success: function(response){
            console.log(response);
            $('#add').html(response);
            //show modal
            $('#AddProduct').modal('show');
            $('#addPro').attr('disabled',false);
        },
    });
}

// ถ้ากดแก้ไขบัญชี ให้ดึงข้อมูลมาแสดงใน modal
$('[id^=Edit]').click(function(){
    var id = $(this).data('id');
    $.ajax({
        url: '../global/product/product.php',
        type: 'post',
        data: {Proedit: id},
        beforeSend: function(){
            $('[id^=Edit]').attr('disabled',true);
        },
        success: function(response){
            console.log(response);
            $('#edit').html(response);
            //show modal
            $('#EditProduct').modal('show');
            $('[id^=Edit]').attr('disabled',false);
        },
    });
});
