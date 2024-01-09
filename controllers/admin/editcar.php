<?php

// Authenticating user
$admin = admin_logged_in();

// Authorizing view
if (!isset($_GET['id'])) {
    // redirect back to cars if id not passed to url
    redirect('cars');
} else {
    $id = intval($_GET['id']);
    $car = query_fetch("SELECT * FROM cars WHERE id = $id LIMIT 1")[0];

    if (empty($car)) {
        // redirect back to cars if car does not exists
        redirect('cars');
    } else {
        // we use this to store car images
        // and altenate car id for users
        $car_id = $car['car_id'];
    }
}

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Edit Car";
$categories = query_fetch("SELECT * FROM car_categories");

// Handling edit car request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Checking available button status
    if (!isset($_POST['available'])) {
        $available = 0;
    } else {
        $available = 1;
    }

    // Declaring DB variables in array
    $data = [
        'car_id' => $car_id,
        'category_id' => sanitize_input($_POST['category']),
        'name' => sanitize_input($_POST['name']),
        'color' => sanitize_input($_POST['color']),
        'description' => $_POST['description'],
        'price' => sanitize_input($_POST['price']),
        'available' => $available
    ];

    try {
        $query = "UPDATE cars SET category_id = :catgory_id, name = :name, color = :color, description = :description, price = :price, available = :available WHERE car_id = :car_id LIMIT 1";
        $query = query_db($query, $data);

        // Updating car images
        if (!empty($_FILES['images'])) {
            // Deleting previous car images
            $car_images = query_fetch("SELECT * FROM car_images WHERE car_id = '$car_id'");
            // Looping through all connected image
            foreach($car_images as $car_image) {
                $image_name = $car_image['image'];
                // Creating link or path to the image file
                $filename = MEDIA_PATH.'cars/'.$image_name;

                if (file_exists($filename)) {
                    // Deleting image from media folder
                    unlink($filename);
                }
                // Deleting image record from database
                query_fetch("DELETE FROM car_images WHERE image = '$image_name' LIMIT 1");
            }
            // Uploading new images
            $uploaded_images = handle_multiple_image($_FILES['images'], 'cars');

            if ($uploaded_images['status'] == "success" || $uploaded_images['status'] == "partial") {

                // Saving each image to DB
                foreach ($uploaded_images['images'] as $image) {
                    $query = "INSERT INTO car_images (car_id, image) VALUES (:car_id, :image)";
                    $query = query_db($query, ['car_id'=>$car_id, 'image'=>$image]);
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
        $message = "Car details was successfully updated";
        $message_tag = "success";
        redirect('cars', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect("editcar?id=$car_id", $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'admin'=> $admin,
    'title'=> $title,
    'car'=> $car
];

admin_view('editcar', $context);