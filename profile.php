<?php
session_start();
require "config.php";   //add mysql configurations

printf('<html><head><link rel="stylesheet" type="text/css" href="styles/main.css"><title>Profile</title></head><body>');


$loggedin = false;
if(isset($_SESSION['username']) && isset($_SESSION['password']))
{
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $result = mysql_query("select * from users where (users_username = '$username' or users_email = '$username') and (users_password = '$password')");
    if(mysql_num_rows($result) != 0)
    {
        //printf("<a href=logout.php>Logout</a><div align=right>Welcome <b><font size=5>".$username."</font></b></div>");
        $row = mysql_fetch_array($result);
        printf('<img src=' . $row['users_photourl'] . '>');
        printf('<h3>'.$row['users_firstname'].' '.$row['users_lastname'].'</h3>');
        printf('<p>'.$row['users_description'].'</p>');
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
