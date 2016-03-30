<?php
    session_start();
    define('db_host','localhost');
    define('db_user','root');
    define('db_pass','');
    define('db_name','social');
    mysql_connect(db_host, db_user, db_pass) or
        die("Could not connect: " . mysql_error());
    mysql_select_db(db_name);

    printf('<html><head><link rel="stylesheet" type="text/css" href="styles/main.css"><title>Profile</title></head><body>');
    

    $loggedin = false;
    if(isset($_SESSION['username']) && isset($_SESSION['password']))
    {
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $result = mysql_query("select * from users where (users_username = '".$username."' or users_email = '".$username."') and (users_password = '".$password."')");
        if(mysql_num_rows($result) != 0)
        {
            //printf("<a href=logout.php>Logout</a><div align=right>Welcome <b><font size=5>".$username."</font></b></div>");
            $row = mysql_fetch_row($result);
            printf('<img src=' . $row[4] . '>');
            printf('<h3>'.$row[1].' '.$row[2].'</h3>');
            printf('<p>'.$row[6].'</p>');
            $loggedin = true;
        }
        else
        {
            printf('<div align=right><h3><a href="login.php">Login</a> <a href="signup.php">Register</a></h3></div>');
        }
    }
    else
    {
        printf('<div align=right><h3><a href="login.php">Login</a> <a href="signup.php">Register</a></h3></div>');
    }

    printf('</body></html>');
?>
