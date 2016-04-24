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
            //print_r($_SESSION);
            
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
                    //printf("<a href=logout.php>Logout</a><div align=right>Welcome <b><font size=5>".$username."</font></b></div>");
                    $row = mysql_fetch_array($result);
                    printf("<a href=logout.php>Logout</a><div align=right>Welcome <b><font size=5><a href=profile.php>".$username.'</a> <img src='.$row['users_photourl'].' width=50 height=50>'."</font></b></div>");
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
        
            //Print the posts on the screen
            $result = mysql_query("select * from posts");
        
        
        
            while ($row = mysql_fetch_array($result)) 
            {
                $title = $row['posts_title'];
                $content = $row['posts_content'];
                $date = $row['posts_date'];
                $username = $row['posts_title'];
                printf("<font color=red><h1>$title</h1></font>");
                printf("<h6>$username $date</h6>");
                printf("<p>$content</p>");
                printf("<hr>");
            }
            if($loggedin)
            {
                printf("<h2>Add a post!</h2>");
                printf('<form name=post_form action=add_post.php method="get">');
                printf('<input type=text value="Title here" name=title><br>');
                printf("<textArea name=post></textArea><br>");
                printf('<input type=submit value="Add Post">');
                printf('</form>');
            }
            
            
        ?>
    </body>
</html>