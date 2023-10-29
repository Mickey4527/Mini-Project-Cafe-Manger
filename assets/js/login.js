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

function login(){
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const data = {
        username: username,
        password: password
    };
    fetch('/seed/global/auth/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success'){
            window.location.href = data.redirect;
        }
        else{
            document.getElementById('invalid-login').style.display = 'block';
        }
    })
    .catch(error => console.log(error));
}