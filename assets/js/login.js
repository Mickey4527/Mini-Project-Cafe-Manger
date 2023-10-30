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
                $('#username').attr('disabled',true);
                $('#password').attr('disabled',true);
                $('#loginSubmit').attr('disabled',true);
                $('#loading-login').css('display', 'block');
            },
            success: function(response, status, xhr) {
                $('#loading-login').css('display', 'none');
                if(xhr.status == 200){
                    window.location.href = 'index.php';
                }
            },
            error: function(xhr, status, error) {
                if(xhr.status == 400) {
                    $('#loading-login').css('display', 'none');
                    $('#username').attr('disabled',false);
                    $('#password').attr('disabled',false);
                    let error = JSON.parse(xhr.responseText);
                    if(error.type == 'invalid'){
                        $('#invalid_feedback').css('display', 'block');
                        $('#invalid_feedback').html(error.msg);
                    }      
                    $('#loginSubmit').attr('disabled',false);
                }
            }
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