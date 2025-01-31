<?php
require '../control/reg_control.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Registration Page</title>
    <link rel="stylesheet" type="text/css" href="/sellerpage/css/mystyle.css">
</head>
<body>
    <form action="" method="POST" onsubmit="return checkUname() && validateForm();">
        <fieldset>
            <div class="logo-container">
                <img src="/sellerpage/images/file.png" alt="AutoFleet Logo" class="logo">
            </div>
            <h2>Seller Registration Page</h2>
            
            <fieldset>
                <legend>Personal Information</legend>
                <table>
                    <tr>
                        <td id="para1">Your Name:</td>
                        <td><input type="text" name="name" id="uname" placeholder="Your Name"></td>
                        <td><span id="error" class="error"></span></td>
                    </tr>
                    <tr>
                        <td id="para1">Email:</td>
                        <td><input type="email" name="email" placeholder="Email"></td>
                        <td><span id="emailError" class="error"></span></td>
                    </tr>
                    <tr>
                        <td id="para1">Phone Number:</td>
                        <td><input type="tel" id="phone" name="phone" placeholder="Phone Number"></td>
                        <td><span id="phoneError" class="error"></span></td>
                    </tr>
                    <tr>
                        <td>Permanent Address:</td>
                        <td><textarea name="address" placeholder="Address" rows="2" cols="30"></textarea></td>
                    </tr>
                    <tr>
                        <td id="para1">Gender:</td>
                        <td>
                            <input type="radio" name="gender" value="male"> Male
                            <input type="radio" name="gender" value="female"> Female
                            <input type="radio" name="gender" value="other"> Other
                        </td>
                        <td><span id="genderError" class="error"></span></td>
                    </tr>
                    <tr>
                        <td id="para1">Password:</td>
                        <td><input type="password" name="password" placeholder="Password"></td>
                        <td><span id="passwordError" class="error"></span></td>
                    </tr>
                    <tr>
                        <td id="para1">Re-enter password:</td>
                        <td><input type="password" name="re_password" placeholder="Re-enter password"></td>
                    </tr>
                    <tr>
                        <td>Add Profile Photo:</td>
                        <td><input type="file" name="profile_photo"></td>
                    </tr>
                </table>
            </fieldset>
            
            <fieldset>
                <legend>Business Details</legend>
                <table>
                    <tr>
                        <td>Business Name:</td>
                        <td><input type="text" name="business_name" placeholder="Business Name"></td>
                    </tr>
                    <tr>
                        <td>Country of Citizenship:</td>
                        <td><input type="text" name="citizenship" placeholder="Country of Citizenship"></td>
                    </tr>
                    <tr>
                        <td id="para1">Business Type:</td>
                        <td>
                            <select id="business_type" name="business_type">
                                <option value="">Select Business Type</option>
                                <option value="Private Limited Company">Private Limited Company</option>
                                <option value="Industrialist">Industrialist</option>
                                <option value="Corporation">Corporation</option>
                            </select>
                        </td>
                        <td><span id="businessTypeError" class="error"></span></td>
                    </tr>
                    <tr>
                        <td>Tax ID/TIN No:</td>
                        <td><input type="text" name="tax_id" placeholder="Tax ID/TIN No"></td>
                    </tr>
                </table>
            </fieldset>

            <fieldset>
                <legend>Banking Information</legend>
                <table>
                    <tr>
                        <td>Account Holder Name:</td>
                        <td><input type="text" name="account_holder" placeholder="Account Holder Name"></td>
                    </tr>
                    <tr>
                        <td>Bank Account Number:</td>
                        <td><input type="text" id="account_number" name="account_number" placeholder="Account Number"></td>
                        <td><span id="accountError" class="error"></span></td>
                    </tr>
                    <tr>
                        <td>Credit Card Number:</td>
                        <td><input type="text" name="credit_card" placeholder="Credit Card Number"></td>
                    </tr>
                    <tr>
                        <td>Payment Options:</td>
                        <td>
                            <label><input type="checkbox" name="payment_method[]" value="Credit Card"> Credit Card</label><br>
                            <label><input type="checkbox" name="payment_method[]" value="Mobile Banking"> Mobile Banking</label><br>
                            <label><input type="checkbox" name="payment_method[]" value="Cash on Delivery"> Cash on Delivery</label>
                        </td>
                    </tr>
                </table>
            </fieldset>

            <fieldset>
                <legend id="para1">Legal Documents</legend>
                <table>
                    <tr>
                        <td>Upload ID (NID/Passport/Driver’s License):</td>
                        <td><input type="file" name="id_upload"></td>
                    </tr>
                    <tr>
                        <td>Business License (if applicable):</td>
                        <td><input type="file" name="business_license"></td>
                    </tr>
                    <tr>
                        <td>TIN Certificate:</td>
                        <td><input type="file" name="tin_certificate"></td>
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
    <script src="../js/myjs.js"></script>
</body>
</html>
