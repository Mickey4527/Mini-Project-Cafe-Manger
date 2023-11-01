/* check password */
function checkPassword(){
    const password = document.getElementById('password').value
    const passwordCheck = document.getElementById('password-check').value
    ;
    if(password !== passwordCheck){
        document.getElementById('password-check-invalid').style.display = 'block';
        document.getElementById('registerSubmit').disabled = true;
    }
    if(password === passwordCheck|| passwordCheck === ''){
        document.getElementById('password-check-invalid').style.display = 'none';
        document.getElementById('registerSubmit').disabled = false;
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

$(document).ready(function() {
    $('#registerSubmit').click(function(){
        let firstName = $('#firstName').val();
        let lastName = $('#lastName').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let passwordCheck = $('#password-check').val();

        if(firstName === ''){
            $('#firstName').addClass('is-invalid');
            $('#firstName-invalid').html('กรุณากรอกชื่อ');
            return false;
        }
        if(lastName === ''){
            $('#lastName').addClass('is-invalid');
            $('#lastName-invalid').html('กรุณากรอกนามสกุล');
            return false;
        }
        if(email === ''){
            $('#email').addClass('is-invalid');
            $('#email-invalid').html('กรุณากรอกอีเมล');
            return false;
        }
        if(password === ''){
            $('#password').addClass('is-invalid');
            $('#password-invalid').html('กรุณากรอกรหัสผ่าน');
            return false;
        }

        let formData = new FormData();
        formData.append('registerSubmit', true);
        formData.append('firstName', firstName);
        formData.append('lastName', lastName);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('passwordCheck', passwordCheck);

        $.ajax({
            url: '../global/auth/login.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#firstName').attr('disabled',true);
                $('#lastName').attr('disabled',true);
                $('#email').attr('disabled',true);
                $('#password').attr('disabled',true);
                $('#password-check').attr('disabled',true);
                $('#registerSubmit').attr('disabled',true);
                $('#loading-login').css('display', 'block');
            },
            success: function(response, status, xhr) {
                if(xhr.status == 200){
                    $('#loading-login').css('display', 'none');
                    $('#formRegister').html(response);
                }
            },
            error: function(xhr, status, error) {
                if(xhr.status == 400) {
                    $('#loading-login').css('display', 'none');
                    $('#firstName').attr('disabled',false);
                    $('#lastName').attr('disabled',false);
                    $('#email').attr('disabled',false);
                    $('#password').attr('disabled',false);
                    $('#password-check').attr('disabled',false);
                    let error = JSON.parse(xhr.responseText);
                    if(error.type == 'empty'){
                        if(error.firstName){
                            $('#firstName').addClass('is-invalid');
                            $('#firstName-invalid').html(error.msg);
                        }
                        if(error.lastName){
                            $('#lastName').addClass('is-invalid');
                            $('#lastName-invalid').html(error.msg);
                        }
                        if(error.email){
                            $('#email').addClass('is-invalid');
                            $('#email-invalid').html(error.msg);
                        }
                        if(error.password){
                            $('#password').addClass('is-invalid');
                            $('#password-invalid').html(error.msg);
                        }
                    }
                    if(error.type == 'email'){
                        $('#email').addClass('is-invalid');
                        $('#email-invalid').html(error.msg);
                    }
                    $('#registerSubmit').attr('disabled',false);
                }
            }
        });
    });
});

$('body').on('change', '.is-invalid', function(){
    $(this).removeClass('is-invalid');
    $(this).next().html('');
});