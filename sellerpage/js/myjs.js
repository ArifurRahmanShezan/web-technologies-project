function checkUname() {
    var name = document.getElementById("uname").value.trim(); // Get trimmed input value
    const nameRegex = /^[a-zA-Z\s]{2,}$/; // Allow letters and spaces, at least 2 characters

    if (name === "" || !nameRegex.test(name)) {
        document.getElementById("error").innerHTML = "Enter a valid username";
        return false;
    } else {
        document.getElementById("error").innerHTML = ""; // Clear error message
        return true;
    }
}
