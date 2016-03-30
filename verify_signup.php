<?php
    define('db_host','localhost');
    define('db_user','root');
    define('db_pass','');
    define('db_name','social');
    mysql_connect(db_host, db_user, db_pass) or
        die("Could not connect: " . mysql_error());
    mysql_select_db(db_name);
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
    
    //Get the user firstname
    //*********************************************
    $firstname = "";
    if(array_key_exists("firstname",$_POST))
    {
        $firstname = $_POST['firstname'];
    } 
    else if(array_key_exists("firstname",$_GET))
    {
        $firstname = $_GET['firstname'];
    }
    else
    {
        die("Please enter a firstname!");
    }
    //*****************************************

    //Check whether the username is allready taken
    $result = mysql_query("select * from users where users_username = '".$username."'");
    if(mysql_num_rows($result) != 0)
    {
        die("<h1>UserName is already taken!</br>");
    }
    //Add user to the database
    $result = mysql_query("insert into users(users_username,users_password,users_firstname) values('".$username."','".$password."','".$firstname."')");
    
    //Get the user last name
    //*********************************************
    $lastname = "";
    if(array_key_exists("lastname",$_POST))
    {
        $lastname = $_POST['lastname'];
    } 
    else if(array_key_exists("lastname",$_GET))
    {
        $lastname = $_GET['lastname'];
    }
    //*****************************************
    //add name to the database
    if($lastname != "")
        $result = mysql_query("update users set users_lastname = '".$lastname."' where users_username = '".$username."'");

    //Get the user email address
    //*********************************************
    $email = "";
    if(array_key_exists("email",$_POST))
    {
        $email = $_POST['email'];
    } 
    else if(array_key_exists("email",$_GET))
    {
        $email = $_GET['email'];
    }
    //*****************************************
    //add name to the database
    if($email != "")
        $result = mysql_query("update users set users_email = '".$email."' where users_username = '".$username."'");

    //get the user photo url
        if(isset($_FILES['image']))
        {
            $errors= array();
            $file_name = $_FILES['image']['name'];
            if($file_name != "")
            {
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

                $expensions= array("jpeg","jpg","png");

                if(in_array($file_ext,$expensions)=== false)
                {
                    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }

                if($file_size > 2097152)
                {
                    $errors[]='File size must be excately 2 MB';
                }

                if(empty($errors)==true)
                {
                    //generate a new name that was not taken before
                    $i = 0;
                    while(file_exists("photos/".$i.$file_name))
                    {
                        $i++;
                    }
                    $file_name = $i.$file_name;
                    //*********************************************
                    move_uploaded_file($file_tmp,"photos/".$file_name);
                    //echo "Success ".$file_name;
                }
                else
                {
                    print_r($errors);
                    die("!");
                }
            }  
            else 
            {
                $file_name = 'nophoto.png';
            }
        }
        

        $result = mysql_query("update users set users_photourl = 'photos/".$file_name."' where users_username = '".$username."'");

    printf("<h1>Thank you for registration!</h1>");
    printf('<a href="index.php">Back to homepage</a>');
    echo '</body>';
    ?>