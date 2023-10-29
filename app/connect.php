<?php


// This file handles function closely related to the database i.e acts
// like a migration file but does extra such as query functions
// Note that our DB parameters/variables are coming from the config file

/*
//////////////////// NON PDO ////////////////////

// NON PDO CONNECTION
try {
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
} catch (mysqli_sql_exception) {
    echo "Database Connection Error: " . mysqli_connect_error() . "<br>";
};

// GENERAL QUERY FUNCTION
function query(string $sql_query){
    global $conn;
    try {
        $result = mysqli_query($conn, $sql_query);
    } catch (Exception $e) {
        echo "Oops.. Could not fetch data!";
    };

    if (!empty($result)) {
        return $result;
    }
    return false;
}

// FUNCTION TO QUERY ALL ITEMS FROM A TABLE
function query_select_all(string $table){
    global $conn;
    try {
        $sql_query = "SELECT * FROM $table";
        $result = mysqli_query($conn, $sql_query);
    } catch (Exception $e) {
        echo "Oops.. Could not fetch data!";
    };

    if (!empty($result)) {
        return $result;
    }
    return false;
}
*/



//////////////////// PDO ////////////////////

// FUNCTION TO CREATE DB AND TABLES
function create_tables() {
    /*
    Note that this is the only PDO function that does not require DB name
    as we may likely create our own database from here before populating tables.

    Note that the DB engine used here is mysql so replace "mysql" with 
    current engine if required
    */

    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";";
    $con = new PDO($string, DBUSER, DBPASS);

    // Creating a database
    $query = "create database if not exists ". DBNAME;
    $statement = $con->prepare($query);
    $statement->execute();

    // Telling SQL to use our created database
    $query = "use ". DBNAME;
    $statement = $con->prepare($query);
    $statement->execute();

    $query = "create table if not exists company(

        id int primary key auto_increment,
        logo varchar(600) null,
        name varchar(30) not null,
        domain varchar(60) not null,
        address varchar(100) not null,
        email varchar(60) not null,
        phone varchar(30) not null,
        whatsapp_link varchar(200) null

    )";
    $statement = $con->prepare($query);
    $statement->execute();

    $query = "create table if not exists users(

        id int primary key auto_increment,
        profile_pic varchar(250) null,
        username varchar(30) not null,
        email varchar(60) not null,
        password varchar(255) not null,
        date_joined datetime default current_timestamp,
        is_staff tinyint default 0,
        is_superuser tinyint default 0, 
        is_blocked tinyint default 0,

        key email (email),
        key username (username)
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    $query = "create table if not exists cars(

        id int primary key auto_increment,
        user_id int null,
        image varchar(250) not null,
        name varchar(60) not null,
        color varchar(60) null,
        description text(2050) null,
        price int not null,
        available tinyint default 0,
        date_uploaded datetime default current_timestamp

    )";
    $statement = $con->prepare($query);
    $statement->execute();

    $query = "create table if not exists messages(

        id int primary key auto_increment,
        name varchar(60) not null,
        email varchar(60) not null,
        phone varchar(60) null,
        subject varchar(60) null,
        message text(2050) not null,
        date datetime default current_timestamp

    )";
    $statement = $con->prepare($query);
    $statement->execute();
}

// FUNCTION TO DROP TABLES
function drop_table(string $table) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $query = "drop table if exists $table";
    $statement = $con->prepare($query);
    $statement->execute();
}

// GENERAL QUERY FUNCTION FOR PDO
function query_db(string $query, array $data = []) {
    /*
    Remember that the passed in query string must have postponed parameters
    or values which is to be provided later using $data array passed into the
    function as well i.e

    $query = "insert into users (username, password) values (:username, :password)";

    or

    $query = "update users set username = :username, email = :email where id = 1 limit 1";

    :username and :password indicates to be provided later or during query execution

    $data == [] by default which won't cause errors when not inserting values which means
    we can also use this function to fetch and delete from DB
    */


    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $statement = $con->prepare($query);
    $statement->execute($data);

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($result) && !empty($result)) {
        return $result;
    }
    return [];
}

// QUERY FUNCTION TO FETCH WITH PDO
function query_fetch(string $query) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $result = $con->query($query);
    $result = $result->fetchAll(PDO::FETCH_ASSOC);

    if (is_array($result) && !empty($result)) {
        return $result;
    }
    return [];
}