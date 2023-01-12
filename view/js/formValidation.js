// form validation code will land here
function formValidation() {
	var Username = document.getElementById('user').value;
	var Password = document.getElementById('pass').value;
	var accessRights = document.getElementById('access').value;
	var Firstname = document.getElementById('fname').value;
	var Lastname = document.getElementById('lname').value;
	var Email = document.getElementById('email').value;
	var error_message = document.getElementById('error_message');

	error_message.style.padding = "10px";

	var text;
    if(Username.length <5){
        text = "Please enter your Username";
        error_message.innerHTML = text;
        return false;
    }

    if(Password.length <8){
        text = "Password must be more than 8 characters";
        error_message.innerHTML = text;
        return false;
	}

	if(accessRights.length <8){
        text = "Please enter access Rights";
        error_message.innerHTML = text;
        return false;
	}

	if(Firstname.length <12){
        text = "Please enter your Firstname";
        error_message.innerHTML = text;
        return false;
	}

	if(Lastname.length <20){
        text = "Please enter your Lastname";
        error_message.innerHTML = text;
        return false;
	}
	
    if(Email.indexOf("@") == -1 || Email.length < 6){
        text = "Please enter your Email";
        error_message.innerHTML = text;
        return false;
    }
    
    alert("Form Submitted Successfully");
    return true;
}