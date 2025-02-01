function checkUname() {
    const uname = document.getElementById("uname").value;
    const error = document.getElementById("error");
    if (uname.length < 4) {
        error.innerHTML = "Name must be at least 4 characters long.";
        error.style.color = "red";
        return false;
    } else {
        error.innerHTML = "";
        return true;
    }
}

function validateForm() {
    let isValid = true;

    // Email validation
    const email = document.querySelector('input[name="email"]').value;
    const emailError = document.getElementById("emailError");
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(email)) {
        emailError.innerHTML = "Please enter a valid email address.";
        emailError.style.color = "red";
        isValid = false;
    } else {
        emailError.innerHTML = "";
    }

    // Phone number validation
    const phone = document.getElementById("phone").value;
    const phoneError = document.getElementById("phoneError");
    if (!/^\d+$/.test(phone)) {
        phoneError.innerHTML = "Phone number must contain only numbers.";
        phoneError.style.color = "red";
        isValid = false;
    } else {
        phoneError.innerHTML = "";
    }

    // Gender validation
    const gender = document.querySelector('input[name="gender"]:checked');
    const genderError = document.getElementById("genderError");
    if (!gender) {
        genderError.innerHTML = "Please select your gender.";
        genderError.style.color = "red";
        isValid = false;
    } else {
        genderError.innerHTML = "";
    }

    // Password validation
    const password = document.querySelector('input[name="password"]').value;
    const rePassword = document.querySelector('input[name="re_password"]').value;
    const passwordError = document.getElementById("passwordError");
    if (password !== rePassword || password === "") {
        passwordError.innerHTML = "Passwords do not match or are empty.";
        passwordError.style.color = "red";
        isValid = false;
    } else {
        passwordError.innerHTML = "";
    }

    // Business type validation
    const businessType = document.getElementById("business_type").value;
    const businessTypeError = document.getElementById("businessTypeError");
    if (businessType === "") {
        businessTypeError.innerHTML = "Please select a business type.";
        businessTypeError.style.color = "red";
        isValid = false;
    } else {
        businessTypeError.innerHTML = "";
    }

    // Account number validation
    const accountNumber = document.getElementById("account_number").value;
    const accountError = document.getElementById("accountError");
    if (!/^\d+$/.test(accountNumber)) {
        accountError.innerHTML = "Account number must contain only numbers.";
        accountError.style.color = "red";
        isValid = false;
    } else {
        accountError.innerHTML = "";
    }

    return isValid;
}
function searchAd() {
    // var query = document.getElementById("search").value; // Get the search input value
    // var xhttp = new XMLHttpRequest(); // Create an XMLHttpRequest object

    // xhttp.onreadystatechange = function () {
    //     if (this.readyState == 4 && this.status == 200) {
    //         // Update the results container with the response
    //         document.getElementById("ad-results").innerHTML = this.responseText;
    //     }
    // };

    // // Send the request to the search endpoint
    // xhttp.open("GET", "http://localhost/sellerpage/control/search_ad.php?query=" + query, true);
    // xhttp.send();
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            let query = $(this).val();

            // Clear the previous results
            $("#ad-results").empty();
                // Show the filtered results based on the query
                $.ajax({
                    url: "../../control/search_ad.php",
                    method: "POST",
                    data: { search: query },
                    success: function(data) {
                        $("#ad-results").html(data);
                    }
                });
        });
    });
}