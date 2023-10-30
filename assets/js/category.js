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
});