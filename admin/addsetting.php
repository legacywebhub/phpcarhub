<?php
require("../app/init.php");

// Authorizing user
$user = logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Add Setting";


// Handling add setting request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && isset($_POST['addsetting'])) {

    // Checking if there is an existing record
    $record = query_fetch("SELECT * FROM company");
    if (count($record) > 0) {
        $message = "Record already exists";
        redirect('settings', $message, "danger");
    }

    // Declaring DB variables as PHP array
    $data = [];
    $data['name'] = $_POST['name'];
    $data['domain'] = $_POST['domain'];
    $data['address'] = $_POST['address'];
    $data['email'] = $_POST['email'];
    $data['phone'] = $_POST['phone'];
    $data['whatsapp_link'] = $_POST['whatsapp_link'];
    
    
    if (empty($_FILES['logo']['name'])) {
        // If logo was not sent
        try {
            $query = "INSERT INTO company (name, domain, address, email, phone, whatsapp_link) VALUES (:name, :domain, :address, :email, :phone, :whatsapp_link)";
            $query = query_db($query, $data);
            $message = "Company details was successfully uploaded";
            $message_tag = "success";
            redirect('settings', $message, $message_tag);
        } catch(Exception $error) {
            $message = "Error while saving data";
            $message_tag = "danger";
        }
    } else {
        // Otherwise
        try {
            $upload_image = handle_image($_FILES['logo']);

            if ($upload_image['status'] == "success") {
                $data['logo'] = $upload_image['new_file_name'];
                $query = "INSERT INTO company (logo, name, domain, address, email, phone, whatsapp_link) VALUES (:logo, :name, :domain, :address, :email, :phone, :whatsapp_link)";
                $query = query_db($query, $data);
                $message = "Company details was successfully uploaded";
                $message_tag = "success";
                redirect('settings', $message, $message_tag);
            } else {
                $message = $upload_image['message'];
                $message_tag = "danger";
            }
        } catch(Exception $error) {
            $message = "Error while saving data";
            $message_tag = "danger";
        }
    }
    redirect('addsetting', $message, $message_tag);
}


$context = [
    'company'=> $company,
    'user'=> $user,
    'title'=> $title,
];

admin_view('addsetting', $context);