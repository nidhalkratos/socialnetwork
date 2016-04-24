<?php 
session_start();
require "config.php";
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
        <?php
            
            
            //Get the post content
            //*********************************************
            $post = "";
            if(array_key_exists("post",$_POST))
            {
                $post = $_POST['post'];
            } 
            else if(array_key_exists("post",$_GET))
            {
                $post = $_GET['post'];
            }
            else
            {
                die("Please write post content!");
            }
            //*****************************************
        
            //Get the post title
            //*********************************************
            $title = "";
            if(array_key_exists("title",$_POST))
            {
                $title = $_POST['title'];
            } 
            else if(array_key_exists("title",$_GET))
            {
                $title = $_GET['title'];
            }
            else
            {
                die("Please write post title!");
            }
            //*****************************************
        
            //user credentials 
            $loggedin = false;
            if(isset($_SESSION['username']) && isset($_SESSION['password']))
            {
                $username = $_SESSION['username'];
                $password = $_SESSION['password'];
                $result = mysql_query("select * from users where (users_username = '".$username."' or users_email = '".$username."') and (users_password = '".$password."')");
                if(mysql_num_rows($result) != 0)
                {
                    $row = mysql_fetch_array($result);
                    printf("<div align=right>Welcome <b><font size=5>".$username.'<img src='.$row['users_photourl'].' width=50 height=50>'."</font></b></div>");
                    //printf('<img src='.$row[4].' width=200 height=200>');
                    $loggedin = true;
                    $query = "insert into posts values(" . "'" .$title . "','" . $post . "',now(),'" . $username . "')";
                    mysql_query($query) or die($query);
                }
                else
                {
                    printf('<div align=right><h3><a href="login.php">Login</a> <a href="signup.php">Register</a></h3></div>');
                    die('<h1>Please Login first</h1>');
                }
            }
            else
            {
                printf('<div align=right><h3><a href="login.php">Login</a> <a href="signup.php">Register</a></h3></div>');
                die('<h1>Please Login first</h1>');
            }
            
            printf("Your post has been added!");
            printf('<a href="index.php">Back to homepage</a>');
            
            
        ?>
    </body>
</html>