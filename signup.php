<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
        <h1>SignUp</h1>
        <form name="signup_form" action="verify_signup.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>UserName</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>PassWord</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" name="firstname"></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="lastname"></td>
                </tr>
                <tr>
                    <td>Photo Url</td>
                    <!--<td><input type="text" name="photourl"></td>-->
                    <td><input type="file" name="image" /></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Signup"></td>
                </tr>
            </table>
            
        </form>
    </body>
</html>