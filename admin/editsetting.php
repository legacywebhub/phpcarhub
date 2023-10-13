<?php
require("../app/init.php");

// Authorizing user
$user = logged_in();

// Redirecting if no setting ID was provided
if (!isset($_GET['id'])) {
    redirect('settings');
} else {
    $id = intval($_GET['id']);
    $setting = query_fetch("SELECT * FROM company WHERE id = $id LIMIT 1")[0];

    // Redirecting if setting id does not exists
    if (empty($setting)) {
        redirect('settings');
    }
    $setting_id = $setting['id'];
}

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Edit Setting";

// Handling incoming post request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && isset($_POST['editsetting'])) {
    // Declaring variables
    $data = [];
    $data['id'] = $setting_id;

    if (empty($_POST['name'])) {
        $data['name'] = $setting['name'];
    } else {
        $data['name'] = $_POST['name'];
    }

    if (empty($_POST['domain'])) {
        $data['domain'] = $setting['domain'];
    } else {
        $data['domain'] = $_POST['domain'];
    }

    if (empty($_POST['address'])) {
        $data['address'] = $setting['address'];
    } else {
        $data['address'] = $_POST['address'];
    }

    if (empty($_POST['email'])) {
        $data['email'] = $setting['email'];
    } else {
        $data['email'] = $_POST['email'];
    }

    if (empty($_POST['phone'])) {
        $data['phone'] = $setting['phone'];
    } else {
        $data['phone'] = $_POST['phone'];
    }

    if (empty($_POST['whatsapp_link'])) {
        $data['whatsapp_link'] = $setting['whatsapp_link'];
    } else {
        $data['whatsapp_link'] = $_POST['whatsapp_link'];
    } 
    
    if (empty($_FILES['logo']['name'])) {
        $query = "UPDATE company SET name = :name, domain = :domain, address = :address, email = :email, phone = :phone, whatsapp_link = :whatsapp_link where id = :id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Company details was successfully uploaded";
        $message_tag = "success";
        redirect('settings', $message, $message_tag);
    } else {
        try {
            // Validate and process logo image
            $upload_image = handle_image($_FILES['logo']);

            if ($upload_image['status'] == "success") {
                // Delete previous logo image
                $previous_logo = MEDIA_ROOT . $setting['logo'];
                if (file_exists($previous_logo)) {
                    unlink($previous_logo);
                }
                // Setting uploaded image as new logo
                $data['logo'] = $upload_image['new_file_name'];
                $query = "UPDATE company SET logo = :logo, name = :name, domain = :domain, address = :address, email = :email, phone = :phone, whatsapp_link = :whatsapp_link where id = :id LIMIT 1";
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
        redirect_to("editsetting.php?id=$setting_id", $message, $message_tag);
    }
    
}


$context = [
    'company'=> $company,
    'user'=> $user,
    'title'=> $title,
    'setting' => $setting
];

admin_view('editsetting', $context);