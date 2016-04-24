create database social;

create table users(
    users_username varchar(20) primary key,
    users_email varchar(50),
    users_password varchar(100), 
    users_firstname varchar(30),
    users_lastname varchar (30),
    users_photourl varchar (200),
    users_description varchar(5000)
    
);


create table posts(
    posts_title varchar(50) not null,
    posts_content varchar(10000),
    posts_date date,
    posts_username varchar(20) references users(users_username) on delete cascade
);

create table settings(
    propriety varchar(20) primary key,
    value varchar(50)
);