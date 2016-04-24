<?php
session_start();
require "config.php";
echo '<html><head><link rel="stylesheet" type="text/css" href="styles/main.css"></head><body>';

//Get the user username
//*********************************************
$username = "";
if(array_key_exists("username",$_POST))
{
    $username = $_POST['username'];
} 
else if(array_key_exists("username",$_GET))
{
    $username = $_GET['username'];
}
else
{
    die("Please enter a username!");
}
//*****************************************

//Get the user password
//*********************************************
$password = "";
if(array_key_exists("password",$_POST))
{
    $password = $_POST['password'];
} 
else if(array_key_exists("password",$_GET))
{
    $password = $_GET['password'];
}
else
{
    die("Please enter a password!");
}
//*****************************************

//check if username and password are correct
$result = mysql_query("select * from users where (users_username = '".$username."' or users_email = '".$username."') and (users_password = '".$password."')");
if(mysql_num_rows($result) == 0)
{
    $result = mysql_query("select * from users where users_username = '".$username."' or users_email = '".$username."'");
    if(mysql_num_rows($result) == 0)
    {
        die("<h1>User was not found!</br>");
    }
    else
    {
        die("<h1>The password you entered for this user is WRONG!</br>");
    }
}
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
printf('<h1>You are logged In!</h1><a href="index.php">Back to homepage</a>');
echo '</body>';

?>