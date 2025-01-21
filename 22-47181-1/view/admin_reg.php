<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>

<body>
    <form action="../control/reg_control.php" method="post">
        <fieldset>
            <legend><h>Admin Details</h></legend>
            <table>
                <tr>
                    <td>First Name :</td>
                    <td><input type="text" name="fname" placeholder="Enter Your First Name" ></td>
                </tr>
                <tr>
                    <td>Phone Number :</td>
                    <td><input type="number" name="num" placeholder="Phone"></td>
                </tr>
                <tr>
                    <td>Date of Birth :</td>
                    <td><input type="date" name="dob"></td>
                </tr>
                <tr>
                    <td>Present Address :</td>
                    <td><textarea name="adress" id="" cols="30" rows="4"
                            placeholder="Enter Your Present Address"></textarea></td>
                </tr>
                <tr>
                    <td>Gender :</td>
                    <td>
                        <label for="101">
                            <input type="radio" name="gender" value="Male" id="101">Male
                        </label>
                        <label for="102">
                            <input type="radio" name="gender" value="Female" id="102">Female
                        </label>
                        <label for="103">
                            <input type="radio" name="gender" value="Others" id="103">Others
                        </label>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        
        <br>
        <fieldset>
            <legend><b>Login Details</b></legend>
            <table>
                <tr>
                    <td>Email :</td>
                    <td><input type="email" name="gml" placeholder="abcd@gmail.com"></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type="password" name="pass" placeholder="Enter Your Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password :</td>
                    <td><input type="password" name="cpass" placeholder="Re-Enter to Confirm"></td>
                </tr>
            </table>
        </fieldset>
        <br>
        <table>
            <tr>
                <td><input type="submit" value="Confirm"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="reset" value="Clear"></td>
            </tr>
        </table>
    </form>
</body>

</html>