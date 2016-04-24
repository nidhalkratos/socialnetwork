<?php
define('db_host','localhost'); 
define('db_user','root');   // change root with your mysql user
define('db_pass','');       // change the empty string with your mysql password
define('db_name','social'); // change social with your database name


mysql_connect(db_host, db_user, db_pass) or
    die("Could not connect: " . mysql_error());
mysql_select_db(db_name);

$tables = array('users','posts','settings');
foreach($tables as $table){
    if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '$table'"))==1) 
    {
        //echo "SHOW TABLES LIKE '$table'<br>";
        // Nothing to do here, everything is working fine!    
    }
    else 
    {
        initialize_db(db_name);
        break;
        //echo "SHOW TABLES LIKE '$table'<br>";
    }   
}

function initialize_db($db)
{
    mysql_select_db($db);
    //creating users table
    mysql_query("drop table users");
    mysql_query("create table users(
        users_username varchar(20) primary key,
        users_email varchar(50),
        users_password varchar(100), 
        users_firstname varchar(30),
        users_lastname varchar (30),
        users_photourl varchar (200),
        users_description varchar(5000));");
    
    //creating posts table
    mysql_query("drop table posts");
    mysql_query("create table posts(
        posts_title varchar(50) not null,
        posts_content varchar(10000),
        posts_date date,
        posts_username varchar(20) references users(users_username) on delete cascade);");
    
    //creating settings table
    mysql_query("drop table settings");
    mysql_query("create table settings(
        propriety varchar(20) primary key,
        value varchar(50));");
    
    // adding settings
    mysql_query("insert into settings values('initialized','true')");
}