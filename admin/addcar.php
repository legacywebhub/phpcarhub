<?php
require("../app/init.php");

// Authorizing user
$user = logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Add Car";


// Handling add car request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && isset($_POST['addcar'])) {

    $image = $_FILES['image'];
    $name = $_POST['name'];
    $color = $_POST['color'];
    $description =  $_POST['description'];
    $price = intval($_POST['price']);

    try {
        $upload_image = handle_image($image);

        if ($upload_image['status'] == "success") {
            $data = [];
            $data['image'] = $upload_image['new_file_name'];
            $data['name'] = $name;
            $data['color'] = $color;
            $data['description'] = $description;
            $data['price'] = $price;
            $data['available'] = 1;
        
            $query = "INSERT INTO CARS (image, name, color, description, price, available) VALUES (:image, :name, :color, :description, :price, :available)";
            $query = query_db($query, $data);
            $message = "Car was successfully uploaded";
            $message_tag = "success";
            redirect('cars', $message, $message_tag);
        } else {
            $message = $upload_image['message'];
            $message_tag = "danger";
        }
    } catch(Exception $error) {
        $message = "Error while saving data";
        $message_tag = "danger";
    }
    redirect('addcar', $message, $message_tag);
}


$context = [
    'company'=> $company,
    'user'=> $user,
    'title'=> $title,
];

admin_view('addcar', $context);