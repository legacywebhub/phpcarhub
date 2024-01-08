<?php

// Authenticating user
$admin = logged_in();

// Authorizing view
if (!isset($_GET['id'])) {
    // redirect back to users if id not passed to url
    redirect('users');
} else {
    $id = intval($_GET['id']);
    $matching_user = query_fetch("SELECT * FROM users WHERE id = $id LIMIT 1");

    if (empty($matching_user)) {
        // redirect back to users if user does not exists
        redirect('users');
    } else {
        $this_user = $matching_user[0];
        $this_user_id = intval($this_user['id']);
    }
}
// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Edit User";

// Handling edit user request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    if (!empty($_POST['password1']) && !empty($_POST['password2'])) {
        if ($_POST['password1'] != $_POST['password2']) {
            $message = 'Passwords do not match';
            $message_tag = 'danger';
            redirect("edituser?id=$this_user_id", $message, $message_tag);
        } else {
            $this_user_password = password_hash($_POST['password2'], PASSWORD_DEFAULT);
        }
    } else {
        $this_user_password = $this_user['password'];
    }
    
    if (!empty($_POST['username'])) {
        $this_user_username = $_POST['username'];
    } else {
        $this_user_username = $this_user['username'];
    }
    
    if (!empty($_POST['email'])) {
        $this_user_email = $_POST['email'];
    } else {
        $this_user_email = $this_user['email'];
    }

    if (isset($_POST['is_staff'])) {
        $this_user_is_staff = 1;
    } else {
        $this_user_is_staff = $this_user['is_staff'];
    }

    if (isset($_POST['is_superuser'])) {
        $this_user_is_superuser = 1;
    } else {
        $this_user_is_superuser = $this_user['is_superuser'];
    }

    if (isset($_POST['is_blocked'])) {
        $this_user_is_blocked = 1;
    } else {
        $this_user_is_blocked = $this_user['is_blocked'];
    }

    // Declaring DB variables
    $data = [];
    $data['id'] = $this_user_id;
    $data['username'] = $this_user_username;
    $data['email'] = $this_user_email;
    $data['password'] = $this_user_password;
    $data['is_staff'] = $this_user_is_staff;
    $data['is_superuser'] = $this_user_is_superuser;
    $data['is_blocked'] = $this_user_is_blocked;


    if (!empty($_FILES['profile_pic']['name'])) {
   
        try {
            $upload_image = handle_image($_FILES['profile_pic'], 'users');

            if ($upload_image['status'] == "success") {
                // Adding image to our array
                $data['profile_pic'] = $upload_image['new_file_name'];
                // Deleting old user profile picture
                $old_image = MEDIA_ROOT . "/users/" . $user['profile_pic'];
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                // Making and sending our query
                $query = "UPDATE users SET profile_pic = :profile_pic, username = :username, email = :email, password = :password, is_staff = :is_staff, is_superuser = :is_superuser, is_blocked = :is_blocked WHERE id = :id LIMIT 1";
                $query = query_db($query, $data);
                $message = "User was successfully updated";
                $message_tag = "success";
                redirect('users', $message, $message_tag);
            } else {
                $message = $upload_image['message'];
                $message_tag = "danger";
            }
        } catch(Exception $error) {
            $message = "Unknown error occured";
            $message_tag = "danger";
        }
        
    } else {

        try {
            // Making and sending our query
            $query = "UPDATE users SET username = :username, email = :email, password = :password, is_staff = :is_staff, is_superuser = :is_superuser WHERE id = :id LIMIT 1";
            $query = query_db($query, $data);
            $message = "User was successfully updated";
            $message_tag = "success";
            redirect('users', $message, $message_tag);
        } catch(Exception $error) {
            $message = "Unknown error occured";
            $message_tag = "danger";
        }
        
    }
    redirect("edituser?id=$this_user_id", $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'this_user'=> $this_user,
];

admin_view('edituser', $context);