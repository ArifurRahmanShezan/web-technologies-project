<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Registration</title>
</head>
<body>
    <form action="../control/reg_control.php" method="POST">
        <fieldset>
            <h1>Customer Registration</h1>
            <fieldset>
                <legend>Personal Information</legend>
                <table>
                    <tr>
                        <td>First Name</td>
                        <td><input type="text" name="first_name" placeholder="Enter your first name"required></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="last_name" placeholder="Enter your last name"required></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" placeholder="Enter your email"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="tel" name="phone" placeholder="Enter your phone number"></td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td><input type="date" name="dob"></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>
                            <label>
                                <input type="radio" name="gender" value="male"> Male
                            </label>
                            <label>
                                <input type="radio" name="gender" value="female"> Female
                            </label>
                            <label>
                                <input type="radio" name="gender" value="others"> Others
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Profile Picture</td>
                        <td><input type="file" name="profile_picture"></td>
                    </tr>
                    <tr>
                        <td>National ID/Passport Number</td>
                        <td><input type="number" name="nid_passport" placeholder="Enter your ID or passport number"></td>
                    </tr>
                    <tr>
                        <td>National ID/Passport image</td>
                        <td><input type="file" name="nid_image" id="1"></td>
                    </tr>
                    <tr>
                        <td>Street</td>
                        <td><textarea name="street" id="street" rows="1" cols="20" placeholder="Enter your street address"></textarea></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input type="text" name="city" id="city" placeholder="Enter your city"></td>
                    </tr>
                    <tr>
                        <td>Postal Code</td>
                        <td><input type="number" name="postal_code" placeholder="Enter your postal code"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>
                            <select name="country" id="country">
                                <option value="">Select your country</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="India">India</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Japan">Japan</option>
                                <option value="China">China</option>
                                <option value="USA">USA</option>
                                <option value="UK">UK</option>
                                <option value="UAE">UAE</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>Account Security</legend>
                <table>
                    <tr>
                        <td>Password :</td>
                        <td><input type="password" name="password" placeholder="Enter your password"></td>
                    </tr>
                    <tr>
                        <td>Re-enter Password :</td>
                        <td><input type="password" name="confirm_password" placeholder="Re-enter your password"></td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <label for="agree">
                    <input type="checkbox" name="agree" id="agree" value="yes"> I agree with the 
                    <a href="#" title="terms of services">terms and conditions</a>
                </label>
                <br>
                <table>
                    <tr>
                        <td><input type="submit" value="Submit"></td>
                        <td><input type="reset" value="Clear Form"></td>
                    </tr>
                </table>
            </fieldset>
        </fieldset>
    </form>
</body>
</html>
