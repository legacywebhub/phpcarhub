<?php

// Authenticating admin
$admin = admin_logged_in();

// Authorizing view
if (!isset($_GET['id'])) {
    // Redirect if no comment id passed
    redirect("comments");
} else {

    try {
        $id = intval($_GET['id']);
        $matching_comments = query_fetch("SELECT * FROM comments WHERE id = $id LIMIT 1");

        if (empty($matching_comments)) {
            // Redirect if no matching comment
            redirect("comments");
        } else {
            // Else return comment
            $comment = $matching_comments[0];
        }
    } catch (Exception) {
        redirect("comments");
    }
}

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Edit Comment";


// Handling update comment request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {


    // Declaring DB variables as PHP array
    $data = [
        'id' => intval($comment['id']),
        'name' => sanitize_input($_POST['name']),
        'email' => sanitize_input($_POST['email']),
        'comment' => sanitize_input($_POST['comment'])
    ];
    
    try {
        $query = "UPDATE comments SET name = :name, email = :email, comment = :comment WHERE id = :id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Comment was successfully updated";
        $message_tag = "success";
        redirect('comments', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('editcomment', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'comment' => $comment
];

admin_view('editcomment', $context);