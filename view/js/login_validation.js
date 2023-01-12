function validate() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    if (username == null || username == "") {
        alert("Please enter the username.");
        return false;
    }
    if (password == null || password == "") {
        alert("Please enter the password.");
        return false;
    }
    alert('Login successful');
}

var submit = document.getElementById('send-login');
submit.addEventListener('click', function() {

// validate all fields
var inputRequired = document.querySelectorAll('*[required]');
for (var i = 0; i < inputRequired.length; i++){
    if (inputRequired[i].checkValidity()){
        inputRequired[i].nextElementSibling.classList.add('hide');
    }
    else {
        inputRequired[i].nextElementSibling.classList.remove('hide');
    }
}
});


