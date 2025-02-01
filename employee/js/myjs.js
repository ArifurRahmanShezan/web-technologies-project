function validateForm() {
    // Clear previous error messages
    document.getElementById("nameError").innerHTML = "";
    document.getElementById("passwordError").innerHTML = "";
    document.getElementById("confirmPasswordError").innerHTML = "";

    // Get the form inputs
    var name = document.forms["myForm"]["name"].value;
    var password = document.forms["myForm"]["password"].value;
    var confirmPassword = document.forms["myForm"]["confirm_password"].value;
    
    var valid = true;

    // Validate Name
    if (name == "") {
        document.getElementById("nameError").innerHTML = "Name is required.";
        valid = false;
    }

    // Validate Password
    if (password == "") {
        document.getElementById("passwordError").innerHTML = "Password is required.";
        valid = false;
    } else if (password.length < 6) {
        document.getElementById("passwordError").innerHTML = "Password must be at least 6 characters.";
        valid = false;
    }

    // Validate Confirm Password
    if (confirmPassword == "") {
        document.getElementById("confirmPasswordError").innerHTML = "Confirm Password is required.";
        valid = false;
    } else if (password !== confirmPassword) {
        document.getElementById("confirmPasswordError").innerHTML = "Passwords do not match.";
        valid = false;
    }

    // Return false to prevent form submission if validation fails
    return valid;
}
