// Login Form Validator
function loginValidator() {

	var email = document.getElementById('login_emailField').value;
	var password = document.getElementById('login_passwordField').value;

	if ( email == '' ) {
		login_errorMessage.textContent = "Please enter username or email";
		return false;
	}

	if (password == '') {
		login_errorMessage.textContent = "Please enter password";
		return false;
	}
}

