<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Login";

// Handling sign in request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && isset($_POST['login'])) {
    // Checking for which form was submitted using the name on the button
    // Returns true or false depending on whether it is set or not

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        redirect('login', "Email or password cannot be empty", 'danger');
    } else {
        $user = authenticate_user($email, $password);

        if ($user){
            if ($user['is_staff'] == 0) {
                redirect('login', "Unauthorized access", 'danger');
            } else {
                // Set user session id
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user['username'];
                redirect('dashboard');
            }
        } else {
            redirect('login', "Invalid credentials", 'danger');
        }
    }
        
}

$context = [
    'company'=> $company,
    'title'=> $title,
];


include(APP_PATH . "templates/admin/login.view.php");

unset_message();