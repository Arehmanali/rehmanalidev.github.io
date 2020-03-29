function validateRegisterForm() {
	var first_name = document.forms["registerForm"]["first_name"].value;
	var last_name = document.forms["registerForm"]["last_name"].value;
	var address = document.forms["registerForm"]["address"].value;
	var phone_no = document.forms["registerForm"]["phone_no"].value;
    var username = document.forms["registerForm"]["username"].value;
	var password = document.forms["registerForm"]["password"].value;
	var confirm_password = document.forms["registerForm"]["confirm_password"].value;
    if (first_name === "" || last_name === "" || address === "" || phone_no === "" || username === "" || password === "" || confirm_password === "") {
        alert("You must fill in required fields!");
		return false;
    }
	if (password !== confirm_password){
		alert("Passwords must match!");
		return false;
	}
}

function validateLoginForm() {
    var username = document.forms["loginForm"]["username"].value;
	var password = document.forms["loginForm"]["password"].value;
    if (username === "" || password === "") {
        alert("You must fill in required fields!");
		return false;
    }
}
