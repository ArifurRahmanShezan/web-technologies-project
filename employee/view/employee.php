<?php
require '../control/reg_control.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>

<form action="" method="POST">
    <fieldset>
        <h1>Employee Registration</h1>
        
        <fieldset>
            <legend>Personal Information</legend>
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name" placeholder="Full Name" required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" placeholder="example@domain.com"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Password" required></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td>Date of Birth:</td>
                    <td><input type="date" name="dob" required></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="tel" name="phone" placeholder="Phone Number" required></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>
                        <label><input type="radio" name="gender" value="Male"> Male</label>
                        <label><input type="radio" name="gender" value="Female"> Female</label>
                        <label><input type="radio" name="gender" value="Other"> Other</label>
                    </td>
                </tr>
                <tr>
                    <td>Profile Picture:</td>
                    <td><input type="file" name="profile_picture" accept="image/*"></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><input type="text" name="address" placeholder="Current Address"></td>
                </tr>
                
                <tr>
                    <td>Educational Qualification:</td>
                    <td>
                        <label><input type="checkbox" name="education[]" value="High School"> High School</label><br>
                        <label><input type="checkbox" name="education[]" value="Diploma"> Diploma</label><br>
                        <label><input type="checkbox" name="education[]" value="Bachelor's Degree"> Bachelor's Degree</label><br>
                        <label><input type="checkbox" name="education[]" value="Master's Degree"> Master's Degree</label><br>
                        <label><input type="checkbox" name="education[]" value="PhD"> PhD</label>
                    </td>
                </tr>
                <tr>
                    <td>Upload Document (ID/Passport):</td>
                    <td><input type="file" name="document" accept=".pdf, .doc, .docx, .jpg, .jpeg, .png"></td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend>Job Details</legend>
            <table>
                <tr>
                    <td>Department:</td>
                    <td>
                        <select name="department">
                            <option value="">Select Department</option>
                            <option value="Vehicle Inspector">Vehicle Inspector</option>
                            <option value="Customer Service Representative">Customer Service Representative</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Sales Manager">Sales Manager</option>
                            <option value="Finance">Finance</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Position:</td>
                    <td><input type="text" name="position" placeholder="Position Title"></td>
                </tr>
                
            </table>
        </fieldset>

        <fieldset>
            <legend>Job Experience</legend>
            <table>
                <tr>
                    <td>Previous Job Title:</td>
                    <td><input type="text" name="previous_job_title" placeholder="Previous Job Title"></td>
                </tr>
                <tr>
                    <td>Previous Company Name:</td>
                    <td><input type="text" name="previous_company_name" placeholder="Previous Company Name"></td>
                </tr>
                <tr>
                    <td>Years of Experience:</td>
                    <td><input type="number" name="years_of_experience" placeholder="Years of Experience"></td>
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

<footer class="footer">
    <p>&copy;All Rights Reserved.</p>
</footer>

</body>
</html>
