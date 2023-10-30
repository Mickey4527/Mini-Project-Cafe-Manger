/* check password */
function checkPassword(){
    const password = document.getElementById('password').value
    const passwordCheck = document.getElementById('password-check').value
    ;
    if(password !== passwordCheck){
        document.getElementById('password-check-invalid').style.display = 'block';
    }
    if(password === passwordCheck|| passwordCheck === ''){
        document.getElementById('password-check-invalid').style.display = 'none';
    }
}

$(document).ready(function() {
    $('#loginSubmit').click(function(){
        const username = $('#username').val();
        const password = $('#password').val();
        const callback = $('#callback').val();
        if(username === ''){
            $('#username').addClass('is-invalid');
            $('#username-invalid').html('กรุณากรอกชื่อผู้ใช้');
            return false;
        }
        if(password === ''){
            $('#password').addClass('is-invalid');
            $('#password-invalid').html('กรุณากรอกรหัสผ่าน');
            return false;
        }
        $.ajax({
            url: '../global/auth/login.php',
            type: 'post',
            data: {loginSubmit: true, username: username, password: password, callback: callback},
            beforeSend: function(){
                $('#loginSubmit').attr('disabled',true);
                $('#loading').css('display', 'block');
            },
            success: function(response, status, xhr) {
                $('#loading').css('display', 'none');
                if(xhr.status == 200){
                    window.location.href = 'index.php';
                }
                else{
                    $('#loginSubmit').attr('disabled',false);
                    $('#notify').html(response);
                    const toast = new bootstrap.Toast(document.querySelector('.toast'));
                    toast.show();
                    return false;
                }
            },
        });
    });
    $('#username').keyup(function(){
        $('#username').removeClass('is-invalid');
        $('#username-invalid').html('');
    });
    $('#password').keyup(function(){
        $('#password').removeClass('is-invalid');
        $('#password-invalid').html('');
    });
});