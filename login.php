<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
        <h1>Login</h1>
        <form name="login_form" action="verify_login.php" method="post">
            <table>
                <tr>
                    <td>UserName</td>
                    <td>Password</td>
                </tr>
                <tr>
                    <td><input type="text" name="username"></td>
                    <td><input type="password" name="password"><input type="submit" value="Login"></td>
                </tr>
            </table>
        </form>
    </body>
</html>