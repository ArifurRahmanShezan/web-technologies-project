function validateForm() {
    if (!validateAddress() || !validateAge() || !validateZIP() ) {
        return false; 
    }
    return true; 
}

function validateAddress() {
    var address = document.getElementById("street").value.trim();
    if (address == "") {
        document.getElementById("addressError").innerHTML = "Address field is required.";
        return false;
    } else {
        document.getElementById("addressError").innerHTML = ""; 
        return true;
    }
}

function validateAge() {
    var dobInput = document.getElementById("dob").value;
    if (dobInput == "") {
        document.getElementById("ageError").innerHTML = "Date of Birth is required.";
        return false;
    }

    var birthDate = new Date(dobInput);
    var today = new Date();
    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDiff = today.getMonth() - birthDate.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    if (isNaN(age) || age < 18 || age > 50) {
        document.getElementById("ageError").innerHTML = "Age must be between 18 and 100.";
        return false;
    } else {
        document.getElementById("ageError").innerHTML = ""; 
        return true;
    }
}

function validateZIP() {
    var postalCode = document.getElementById("postal_code").value.trim();
    if (!/^\d{5}$/.test(postalCode)) {
        document.getElementById("zipError").innerHTML = "Zip code must be a 4-digit number.";
        return false;
    } else {
        document.getElementById("zipError").innerHTML = ""; 
        return true;
    }
}



/*document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector("form");
    form.onsubmit = validateForm;
});
*/
