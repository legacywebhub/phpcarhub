<?php

// Authenticating admin
$admin = admin_logged_in();

// Authorizing view
if (!isset($_GET['id'])) {
    // Redirect if no category id passed
    redirect("vehicle-categories");
} else {

    try {
        $id = intval($_GET['id']);
        $matching_categories = query_fetch("SELECT * FROM vehicle_categories WHERE id = $id LIMIT 1");

        if (empty($matching_categories)) {
            // Redirect if no matching categories
            redirect("vehicle-categories");
        } else {
            // Else return category
            $category = $matching_categories[0];
        }
    } catch (Exception) {
        redirect("vehicle-categories");
    }
}

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Edit Vehicle Category";


// Handling edit post category request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Declaring DB variables as PHP array
    $data = [
        'id' => intval($category['id']),
        'category' => strtolower(sanitize_input($_POST['category']))
    ];

    try {
        $query = "UPDATE vehicle_categories SET category = :category WHERE id = :id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Category was successfully updated";
        $message_tag = "success";
        redirect('vehicle-categories', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('editvehiclecategory', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'category'=> $category
];

admin_view('editvehiclecategory', $context);