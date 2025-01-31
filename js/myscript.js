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


function fetchProducts(queryType, queryValue) {
    $.ajax({
        url: "../control/fetch_product.php",
        type: "GET",
        data: { type: queryType, value: queryValue },
        success: function(response) {
            console.log(response);  // Log the response
            $("#product-list").html(response);
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + status + " - " + error);
        }
    });
}


$(document).ready(function(){
    $("#searchAll").click(function(e){
        e.preventDefault();
        $.ajax({
            url: "../control/fetch_product.php",
            type: "GET",
            success: function(response){
                $("#productList").html(response);
            }
        });
    });
    $("#searchById").click(function(e){
        e.preventDefault();
        let pr_id = $("#pr_id").val();
        $.ajax({
            url: "../control/fetch_product.php",
            type: "GET",
            data: { pr_id: pr_id },
            success: function(response){
                $("#productList").html(response);
            }
        });
    });

    $("#searchByName").click(function(e){
        e.preventDefault();
        let p_name = $("#p_name").val();
        $.ajax({
            url: "../control/fetch_product.php",
            type: "GET",
            data: { p_name: p_name },
            success: function(response){
                $("#productList").html(response);
            }
        });
    });
});

function validatePasswords() {
    var newPassword = document.getElementById("new_password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    var errorMessage = document.getElementById("error_message");

    if (newPassword !== confirmPassword) {
        errorMessage.innerHTML = "New password and confirm password do not match.";
        return false;
    }
    errorMessage.innerHTML = "";
    return true;
}



/*document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector("form");
    form.onsubmit = validateForm;
});
*/
