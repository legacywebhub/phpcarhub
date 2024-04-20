<?php

// Authenticating user
$admin = admin_logged_in();

// Authorizing view
if (!isset($_GET['id'])) {
    // redirect back to vehicles if id not passed to url
    redirect('vehicles');
} else {
    $id = intval($_GET['id']);
    $vehicle = query_fetch("SELECT * FROM vehicles WHERE id = $id LIMIT 1")[0];

    if (empty($vehicle)) {
        // redirect back to vehicles if vehicle does not exists
        redirect('vehicles');
    } else {
        // we use this to store vehicle images
        // and altenate vehicle id for users
        $vehicle_id = $vehicle['vehicle_id'];
    }
}

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Edit Vehicle";
$categories = query_fetch("SELECT * FROM vehicle_categories");

// Handling edit vehicle request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Checking and organizing image files
    $images = organise_files($_FILES['images']);

    // Checking available button status
    if (!isset($_POST['available'])) {
        $available = 0;
    } else {
        $available = 1;
    }

    // Declaring DB variables in array
    $data = [
        'vehicle_id' => $vehicle_id,
        'category_id' => sanitize_input($_POST['category']),
        'name' => sanitize_input($_POST['name']),
        'color' => sanitize_input($_POST['color']),
        'description' => $_POST['description'],
        'price' => sanitize_input($_POST['price']),
        'available' => $available
    ];


    try {
        $query = "UPDATE vehicles SET category_id = :category_id, name = :name, color = :color, description = :description, price = :price, available = :available WHERE vehicle_id = :vehicle_id LIMIT 1";
        $query = query_db($query, $data);

        // Updating vehicle images if image was sent
        if (!empty($images[0]['name'])) {
            // Deleting previous vehicle images
            $vehicle_images = query_fetch("SELECT * FROM vehicle_images WHERE vehicle_id = '$vehicle_id'");
            // Looping through all connected image
            foreach($vehicle_images as $vehicle_image) {
                $image_name = $vehicle_image['image'];
                // Creating link or path to the image file
                $filename = MEDIA_PATH.'vehicles/'.$image_name;

                if (file_exists($filename)) {
                    // Deleting image from media folder
                    unlink($filename);
                }
                // Deleting image record from database
                query_fetch("DELETE FROM vehicle_images WHERE image = '$image_name' LIMIT 1");
            }
            // Uploading new images
            $uploaded_images = handle_multiple_image($_FILES['images'], 'vehicles');

            if ($uploaded_images['status'] == "success" || $uploaded_images['status'] == "partial") {

                // Saving each image to DB
                foreach ($uploaded_images['images'] as $image) {
                    $query = "INSERT INTO vehicle_images (vehicle_id, image) VALUES (:vehicle_id, :image)";
                    $query = query_db($query, ['vehicle_id'=>$vehicle_id, 'image'=>$image]);
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
        $message = "Vehicle details was successfully updated";
        $message_tag = "success";
        redirect('vehicles', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect("editvehicle?id=$vehicle_id", $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'admin'=> $admin,
    'title'=> $title,
    'categories'=> $categories,
    'vehicle'=> $vehicle
];

admin_view('editvehicle', $context);