<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Forgot Password";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (!$email) {
        redirect('forgot-password', "Email is not valid", "danger");
    }

    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $token_expires = date("Y-m-d H:i:s", time() + 60*30);
    
    if (email_exists($email)) {
        // Add token and token expiry to user details
        $sql = "UPDATE users SET token_hash = :token_hash, token_expires = :token_expires WHERE email = :email";
        $query = query_db($sql, ['token_hash'=> $token_hash, 'token_expires'=> $token_expires, 'email'=> $email]);
        // Send reset link
        $email_values = ['name'=> '', 'message'=> "Click <a href=".ROOT."/admin/reset-password?token=".$token.">here</a> to reset your password"];
        sendMail($company['email'], $email, "Password Reset", $email_values);
        // Redirect to forgot password page to display message
        redirect('reset-sent');
    } else {
        redirect('forgot-password', "Email does not exist", "danger");
    }
    
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title
];

auth_view('forgot-password', $context);