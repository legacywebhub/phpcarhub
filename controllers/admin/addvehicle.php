<?php

// Authenticating user
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Add Vehicle";
$categories = query_fetch("SELECT * FROM vehicle_categories");


// Handling add vehicle request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // vehicle parameters for BB
    $data = [
        'vehicle_id' => generate_unique_id(7),
        'category_id' => sanitize_input($_POST['category']),
        'name' => sanitize_input($_POST['name']),
        'color' => sanitize_input($_POST['color']),
        'description' => $_POST['description'],
        'price' => intval(sanitize_input($_POST['price'])),
        'available' => 1
    ];


    try {

        $query = "INSERT INTO vehicles (vehicle_id, category_id, name, color, description, price, available) VALUES (:vehicle_id, :category_id, :name, :color, :description, :price, :available)";
        $query = query_db($query, $data);
        
        if (!empty($_FILES['images'])) {
            // Uploading vehicle images
            $uploaded_images = handle_multiple_image($_FILES['images'], 'vehicles');

            if ($uploaded_images['status'] == "success" || $uploaded_images['status'] == "partial") {

                // Saving each image to DB
                foreach ($uploaded_images['images'] as $image) {
                    $query = "INSERT INTO vehicle_images (vehicle_id, image) VALUES (:vehicle_id, :image)";
                    $query = query_db($query, ['vehicle_id'=>$data['vehicle_id'], 'image'=>$image]);
                }
                $message = "Vehicle and ". $uploaded_images['total_uploaded'] ." image was uploaded successfully";
                $message_tag = "success";
                redirect('vehicles', $message, $message_tag);
            } else {
                $message = "Vehicle was uploaded successfully without images";
                $message_tag = "success";
                redirect('vehicles', $message, $message_tag);
            }
        }
        $message = "vehicle was successfully uploaded";
        $message_tag = "success";
        redirect('vehicles', $message, $message_tag);

    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('addvehicle', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'admin'=> $admin,
    'title'=> $title,
    'categories'=> $categories
];

admin_view('addvehicle', $context);