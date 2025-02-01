<?php
session_start();
require '../../model/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../../../view/login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
    <script src="../js/myjs.js"></script> 
</head>
<body>
    

<form id="myForm" action="../control/regcontrol.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <fieldset>
        <h1>Employee Registration</h1>
        
        <fieldset>
            <legend>Personal Information</legend>
            <table>
                <tr>
                    <td>Name:</td>
                    <td>
                        <input type="text" name="name" placeholder="Full Name">
                        <span id="nameError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" id="password" name="password" placeholder="Password">
                        <span id="passwordError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password">
                        <span id="confirmPasswordError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" id="email" name="email" placeholder="example@domain.com">
                        <span id="emailError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Date of Birth:</td>
                    <td>
                        <input type="text" id="dob" name="dob">
                        <span id="dobError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td>
                        <input type="text" id="phone" name="phone" placeholder="Phone Number">
                        <span id="phoneError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>
                        <label><input type="radio" name="gender" value="Male"> Male</label>
                        <label><input type="radio" name="gender" value="Female"> Female</label>
                        <label><input type="radio" name="gender" value="Other"> Other</label>
                        <span id="genderError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Profile Picture:</td>
                    <td>
                        <input type="file" id="profilePicture" name="profile_picture">
                        <span id="profilePictureError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td>
                        <input type="text" id="address" name="address" placeholder="Current Address">
                        <span id="addressError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Educational Qualification:</td>
                    <td>
                        <label><input type="checkbox" name="education[]" value="High School"> High School</label><br>
                        <label><input type="checkbox" name="education[]" value="Diploma"> Diploma</label><br>
                        <label><input type="checkbox" name="education[]" value="Bachelor's Degree"> Bachelor's Degree</label><br>
                        <label><input type="checkbox" name="education[]" value="Master's Degree"> Master's Degree</label><br>
                        <label><input type="checkbox" name="education[]" value="PhD"> PhD</label>
                        <span id="educationError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Upload Document (ID/Passport):</td>
                    <td>
                        <input type="file" id="document" name="document">
                        <span id="documentError" class="error"></span>
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Job Details</legend>
            <table>
                <tr>
                    <td>Department:</td>
                    <td>
                        <select id="department" name="department">
                            <option value="">Select Department</option>
                            <option value="Vehicle Inspector">Vehicle Inspector</option>
                            <option value="Customer Service Representative">Customer Service Representative</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Sales Manager">Sales Manager</option>
                            <option value="Finance">Finance</option>
                        </select>
                        <span id="departmentError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Position:</td>
                    <td>
                        <input type="text" id="position" name="position" placeholder="Position Title">
                        <span id="positionError" class="error"></span>
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Job Experience</legend>
            <table>
                <tr>
                    <td>Previous Job Title:</td>
                    <td>
                        <input type="text" id="previousJobTitle" name="previous_job_title" placeholder="Previous Job Title">
                        <span id="previousJobTitleError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Previous Company Name:</td>
                    <td>
                        <input type="text" id="previousCompanyName" name="previous_company_name" placeholder="Previous Company Name">
                        <span id="previousCompanyNameError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td>Years of Experience:</td>
                    <td>
                        <input type="text" id="yearsOfExperience" name="years_of_experience" placeholder="Years of Experience">
                        <span id="yearsOfExperienceError" class="error"></span>
                    </td>
                </tr>
            </table>
        </fieldset>

        <table>
            <tr>
                <td><input type="submit" value="Register" class="btnpurple"></td>
                <td><input type="reset" value="Clear Form" class="btnregister"></td>
            </tr>
        </table>
    </fieldset>
</form>

<p>Account already created? <a href="../../view/login.php">Login</a></p>

</body>
</html>
