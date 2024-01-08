<?php

// Authenticating user
$admin = logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Add Car";


// Handling add car request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Car parameters for BB
    $data = [
        'car_id' => generate_unique_id(7),
        'name' => sanitize_input($_POST['name']),
        'color' => sanitize_input($_POST['color']),
        'description' => $_POST['description'],
        'price' => intval(sanitize_input($_POST['price'])),
        'available' => 1
    ];


    try {

        $query = "INSERT INTO CARS (car_id, name, color, description, price, available) VALUES (:car_id, :name, :color, :description, :price, :available)";
        $query = query_db($query, $data);
        
        if (!empty($_FILES['images'])) {
            // Uploading car images
            $uploaded_images = handle_multiple_image($_FILES['images'], 'cars');

            if ($uploaded_images['status'] == "success" || $uploaded_images['status'] == "partial") {

                // Saving each image to DB
                foreach ($uploaded_images['images'] as $image) {
                    $query = "INSERT INTO car_images (car_id, image) VALUES (:car_id, :image)";
                    $query = query_db($query, ['car_id'=>$data['car_id'], 'image'=>$image]);
                }
                $message = "Car and ". $uploaded_images['total_uploaded'] ." image was uploaded successfully";
                $message_tag = "success";
                redirect('cars', $message, $message_tag);
            } else {
                $message = "Car was uploaded successfully without images";
                $message_tag = "success";
                redirect('cars', $message, $message_tag);
            }
        }
        $message = "Car was successfully uploaded";
        $message_tag = "success";
        redirect('cars', $message, $message_tag);

    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('addcar', $message, $message_tag);
}


// Generating CSRF Token
$csrf_token = generate_csrf_token();


$context = [
    'company'=> $company,
    'admin'=> $admin,
    'title'=> $title
];

admin_view('addcar', $context);