<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Register";

// Handling register request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && isset($_POST['register'])) {
    // Printing out the $_POST object
    print_r($_POST);

    $username = $_POST['username'];
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];


    // Validation
    if (empty($username) || ctype_space($username)) {
        redirect('register', "Username cannot be blank or have spaces", 'danger');
    } else if (is_numeric($username)) {
        redirect('register', "Username cannot be numeric", 'danger');
    } else if (!preg_match("/^[a-zA-Z]+$/", $username)) {
        redirect('register', "Username can only have letters and no spaces", 'danger');
    } else if (strlen($username) < 5 || strlen($username) > 12) {
        redirect('register', "Username cannot be less than 5 or more than 12 characters", 'danger');
    } else if (username_exists($username)) {
        redirect('register', "Username has already been used", 'danger');
    }

    if (!$email) {
        redirect('register', "Email is not valid", 'danger');
    } else if (strlen($email) > 25) {
        redirect('register', "Email cannot be more than 25 characters", 'danger');
    } else if (email_exists($email)) {
        redirect('register', "Email has already been used", 'danger');
    }

    if (empty($password1) || empty($password2)) {
        redirect('register', "Passwords cannot be empty", 'danger');
    } else if ($password1 != $password2) {
        redirect('register', "Passwords do not match", 'danger');
    }

    // Declaring database variables for user as PHP array
    $data = [];
    $data['username'] = $username;
    $data['email'] = $email;
    $data['password'] = password_hash($password2, PASSWORD_DEFAULT);

    try {
        // Making a connection using PDO
        $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
        $con = new PDO($string, DBUSER, DBPASS);

        // Making a query to insert user details into the database
        $query = "insert into users (username, email, password) values (:username, :email, :password)";
        $statement = $con->prepare($query);
        $statement->execute($data);
        redirect('login', "You were successfully registered", 'success');
    } catch(Exception $e) {
        redirect('register', "Registeration failed: $e", 'danger');
    }

}

$context = [
    'company'=> $company,
    'title'=> $title,
];

include("../templates/admin/register.view.php");

unset_message();