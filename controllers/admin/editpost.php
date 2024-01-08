<?php

// Authenticating admin
$admin = admin_logged_in();

// Authorizing view
if (!isset($_GET['id'])) {
    // Redirect if no post id passed
    redirect("posts");
} else {

    try {
        $id = intval($_GET['id']);
        $matching_posts = query_fetch("SELECT * FROM posts WHERE id = $id LIMIT 1");

        if (empty($matching_posts)) {
            // Redirect if no matching post
            redirect("posts");
        } else {
            // Else return post
            $post = $matching_posts[0];
        }
    } catch (Exception) {
        redirect("posts");
    }
}

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Edit Post";
$categories = query_fetch("SELECT * FROM post_categories");


// Handling edit post request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {


    // Declaring DB variables as PHP array
    $data = [
        'id' => intval($post['id']),
        'category_id' => sanitize_input($_POST['category']),
        'image' => $_POST['image'],
        'title' => sanitize_input($_POST['title']),
        'slug' => create_slug(sanitize_input($_POST['title'])),
        'content' => $_POST['content'],
        'quote' => sanitize_input($_POST['quote']),
    ];
    
    try { // Updating post record
        $query = "UPDATE posts SET category_id = :category_id, image = :image, slug = :slug, title = :title, content = :content, quote = :quote WHERE id = :id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Post was updated successfully";
        $message_tag = "success";
        redirect('posts', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('editpost', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'categories'=> $categories,
    'post'=> $post
];

admin_view('editpost', $context);