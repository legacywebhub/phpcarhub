<?php
require("../app/init.php");

// Authorizing user
$user = logged_in();

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
        $car_id = intval($car['id']);
    }
}

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Edit Car";

// Handling edit car request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && isset($_POST['editcar'])) {

    // Validate
    if (empty($_POST['name'])) {
        $name = $car['name'];
    } else {
        $name = $_POST['name'];
    }

    if (empty($_POST['color'])) {
        $color = $car['color'];
    } else {
        $color = $_POST['color'];
    }

    if (empty($_POST['description'])) {
        $description = $car['description'];
    } else {
        $description = $_POST['description'];
    }

    if (empty($_POST['price'])) {
        $price = $car['price'];
    } else {
        $price = intval($_POST['price']);
    }

    if (!isset($_POST['available'])) {
        $available = 0;
    } else {
        $available = 1;
    }

    // Declaring DB variables in array
    $data = [];
    $data['name'] = $name;
    $data['color'] = $color;
    $data['description'] = $description;
    $data['price'] = $price;
    $data['available'] = $available;
    $data['id'] = $car_id;

    if (empty($_FILES['image']['name'])) {
        try {
            $query = "UPDATE cars SET name = :name, color = :color, description = :description, price = :price, available = :available WHERE id = :id LIMIT 1";
            $query = query_db($query, $data);
            $message = "Car details was successfully updated";
            $message_tag = "success";
            redirect('cars', $message, $message_tag);
        } catch(Exception $error) {
            $message = "Error while saving data: $error";
            $message_tag = "danger";
        }

    } else {
        $upload_image = handle_image($_FILES['image']);

        try {
            if ($upload_image['status'] == "success") {
                // Getting our new file name
                $data['image'] = $upload_image['new_file_name'];
                // Deleting previous linked file
                $old_image = MEDIA_ROOT . $car['image'];
                if (file_exists($old_image)) {
                    // Deleting image
                    unlink($old_image);
                }
                // Making our DB Query
                $query = "UPDATE cars SET image = :image, name = :name, color = :color, description = :description, price = :price, available = :available WHERE id = :id LIMIT 1";
                $query = query_db($query, $data);
                $message = "Car detail was successfully updated";
                $message_tag = "success";
                redirect('cars', $message, $message_tag);
            } else {
                // Setting upload error message
                $message = $upload_image['message'];
                $message_tag = "danger";
            }
        } catch(Exception $error) {
            $message = "Error while saving data: $error";
            $message_tag = "danger";
        }

    }
    redirect_to("editcar.php?id=$car_id", $message, $message_tag);
}


$context = [
    'company'=> $company,
    'user'=> $user,
    'title'=> $title,
    'car'=> $car
];

admin_view('editcar', $context);