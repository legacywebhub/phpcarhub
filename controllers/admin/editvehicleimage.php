<?php

// Authenticating admin
$admin = admin_logged_in();

// Authorizing view
if (!isset($_GET['id'])) {
    // Redirect if no image id passed
    redirect("vehicle-gallery");
} else {

    try {
        $id = intval(sanitize_input($_GET['id']));
        $matched_images = query_fetch("SELECT * FROM vehicle_images WHERE id = $id LIMIT 1");

        if (empty($matched_images)) {
            // Redirect if no matching images
            redirect("vehicle-gallery");
        } else {
            // Else return image
            $image = $matched_images[0];
        }
    } catch (Exception) {
        redirect("vehicle-gallery");
    }
}

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Edit Image";


// Handling image update request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Uploading image
    $uploaded_image = handle_image($_FILES['image'], 'vehicles');
    
    if ($uploaded_image['status'] == "success") {
        // Attempting to delete previous image
        $filename = MEDIA_PATH . "vehicles/".$image['image'];
        if (file_exists($filename)) {
            unlink($filename);
        }

        // Declaring DB variables as PHP array
        $data = [
            'id' => $image['id'],
            'image' => $uploaded_image['new_file_name']
        ];

        try {
            $query = "UPDATE vehicle_images SET image = :image WHERE id = :id LIMIT 1";
            $query = query_db($query, $data);
            redirect('vehicle-gallery', "Image was successfully updated", "success");
        } catch(Exception) {
            redirect("editvehicleimage?id=$id", "Error while saving data", "danger");
        }
        redirect("editvehicleimage?id=$id", "Error while saving data", "danger");
    }
    redirect("editvehicleimage?id=$id", "Upload Error", 'danger');
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'image'=> $image
];

admin_view('editvehicleimage', $context);