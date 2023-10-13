<?php
require("../app/init.php");

// Authorizing user
$user = logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Add User";


// Handling add user request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && isset($_POST['adduser'])) {

    // Validating and determing DB insert values
    if ($_POST['password1'] != $_POST['password2']) {
        redirect('adduser', 'Passwords do not match', 'danger');
    } else {
        $password = $_POST['password2'];
    }

    $username = $_POST['username'];
    $email = $_POST['email'];

    if (isset($_POST['is_staff'])) {
        $is_staff = 1;
    } else {
        $is_staff = 0;
    }

    if (isset($_POST['is_superuser'])) {
        $is_superuser = 1;
    } else {
        $is_superuser = 0;
    }

    // Declaring DB variables
    $data = [];
    $data['username'] = $username;
    $data['email'] = $email;
    $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    $data['is_staff'] = intval($is_staff);
    $data['is_superuser'] = intval($is_superuser);


    if (!empty($_FILES['profile_pic']['name'])) {
        // If logo image was sent
        try {
            $upload_image = handle_image($_FILES['profile_pic']);

            if ($upload_image['status'] == "success") {
                // Adding image to our array
                $data['profile_pic'] = $upload_image['new_file_name'];
                // Making and sending our query
                $query = "INSERT INTO users (profile_pic, username, email, password, is_staff, is_superuser) VALUES (:profile_pic, :username, :email, :password, :is_staff, :is_superuser)";
                $query = query_db($query, $data);
                $message = "User was successfully created";
                $message_tag = "success";
                redirect('users', $message, $message_tag);
            } else {
                $message = $upload_image['message'];
                $message_tag = "danger";
            }
        } catch(Exception $error) {
            $message = "Error while saving data";
            $message_tag = "danger";
        }
        
    } else {
        // Otherwise
        try {
            // Making and sending our query
            $query = "INSERT INTO users (username, email, password, is_staff, is_superuser) VALUES (:username, :email, :password, :is_staff, :is_superuser)";
            $query = query_db($query, $data);
            $message = "User was successfully created";
            $message_tag = "success";
            redirect('users', $message, $message_tag);
        } catch(Exception $error) {
            $message = "Error while saving data";
            $message_tag = "danger";
        }
    }
    redirect('adduser', $message, $message_tag);
}


$context = [
    'user'=> $user,
    'title'=> $title,
    'company'=> $company,
];

admin_view('adduser', $context);