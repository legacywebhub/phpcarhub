<?php

// PHPMAILER

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require APP_PATH."app/PHPMailer/src/Exception.php";
require APP_PATH."app/PHPMailer/src/PHPMailer.php";
require APP_PATH."app/PHPMailer/src/SMTP.php";



//////////////////////// SECURITY FUNCTIONS ///////////////////////////////

// FUNCTION TO SANITIZE USER INPUTS
function sanitize_input($input) {
    // Replace characters that may be used in SQL injection
    $input = str_replace("'", '', $input);
    $input = str_replace('"', '', $input);
    $input = str_replace(';', '', $input);
    $input = str_replace('=', '', $input);

    // Strip HTML and PHP tags
    $input = strip_tags(trim($input));

    return $input;
}

// FUNCTION TO GENERATE CSRF TOKENS
function generate_csrf_token() {
    $csrf_token = bin2hex(random_bytes(32)); // Generate a random token
    $_SESSION['csrf_token'] = $csrf_token; // Store the token in the user's session

    return $csrf_token;
}



//////////////////////// AUTH FUNCTIONS ///////////////////////////////

// FUNCTIONS RETURNS USER DATA IF AUTHENTICATED OR FALSE IS UNAUTHENTICATED
// NOTE THIS FUNCTION DOES NOT REDIRECT OR AUTHORIZE USERS
function is_user_authenticated() {
    if (isset($_SESSION['user'])) {
        // Getting the user id value stored in the session
        $user_id = intval($_SESSION['user']['id']);

        // Making a connection using PDO
        $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
        $con = new PDO($string, DBUSER, DBPASS);

        // Making a query to select item from the database
        $query = "select * from users where id = $user_id limit 1";
        $result = $con->query($query);
        $users = $result->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($users)) {
            // Return the user result
            // if query result not empty 
            return $users[0] ;
        }
    }
    // return empty user array by default
    return [];
}

// FUNCTION REDIRECT USERS TO LOGIN PAGE IF NOT AUTHENTICATED
function logged_in() {
    $user = is_user_authenticated();
    // This function depends on is_user_authenticated() function
    if (empty($user) || $user['is_blocked']==1) {
        // Redirect if no user found or user is blocked
        $url = ROOT."/login";
        redirect($url, "Please sign in", "danger");
    }
    return $user;
}

// FUNCTION REDIRECT ADMIN TO LOGIN PAGE IF NOT AUTHORIZED
function admin_logged_in() {
    $user = is_user_authenticated();
    // This function depends on is_user_authenticated() function
    if (empty($user) || $user['is_staff'] == 0) {
        // Redirect if no user found or user is no admin
        $url = ROOT."/admin/login";
        redirect($url, "Please sign in", "danger");
    }
    return $user;
}

// FUNCTION TO CHECK IF USER EXISTS AND PASSWORD MATCHES DURING LOGIN
function authenticate_user($email, $password) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    // Making a query to select item from the database
    $query = "select * from users where email = '$email' limit 1";
    $result = $con->query($query);
    $users = $result->fetchAll(PDO::FETCH_ASSOC);

    // Result is returned as an array of all matched object even though it's
    // limited to one result, In this case, our user is at the first index
    if (!empty($users) && password_verify($password, $users[0]['password'])) {
        return $users[0];
    }
    return false;
}

// FUNCTION CHECKS IF THE GIVEN EMAIL OF A USER EXISTS IN THE DATABASE
// RETURNS TRUE OF FALSE ONLY
function email_exists($param) {
    try {
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    } catch (mysqli_sql_exception) {
        echo "Database Connection Error: " . mysqli_connect_error() . "<br><br>";
    }

    $query = "select * from users where email = '$param' limit 1";
    $result = mysqli_query($conn, $query);
    // number of results gotten from query
    $results = mysqli_num_rows($result);

    if ($results > 0) {
        return true;
    }
    return false;
}

// FUNCTION CHECKS IF THE GIVEN USERNAME OF A USER EXISTS IN THE DATABASE
// RETURNS TRUE OF FALSE ONLY
function username_exists($param) {
    try {
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    } catch (mysqli_sql_exception) {
        echo "Database Connection Error: " . mysqli_connect_error() . "<br><br>";
    }

    $query = "select * from users where username = '$param' limit 1";
    $result = mysqli_query($conn, $query);
    // number of results gotten from query
    $results = mysqli_num_rows($result);

    if ($results > 0) {
        return true;
    }
    return false;
}



//////////////////////// VIEW FUNCTIONS ///////////////////////////////

// LANDING VIEW FUNCTION
function landing_view($name, $context=[]) {
    // Note that other included file path inside of
    // this layout view is relative to this file path 
    require(APP_PATH . "views/landing/layout.view.php");
    unset_message();
}

// ADMIN VIEW FUNCTION
function dashboard_view($name, $context=[]) {
    // Note that other included file path inside of
    // this layout view is relative to this file path 
    require(APP_PATH . "views/dashboard/layout.view.php");
    unset_message();
}

// ADMIN VIEW FUNCTION
function admin_view($name, $context=[]) {
    // Note that other included file path inside of
    // this layout view is relative to this file path 
    require(APP_PATH . "views/admin/layout.view.php");
    unset_message();
}

// FUNCTION TO UNSET MESSAGE AND MESSAGE TAGS
function unset_message() {
    // Resetting messages after each view has been displayed
    if (isset($_SESSION['message'])) {
        unset($_SESSION['message']);
    }

    if (isset($_SESSION['message_tag'])) {
        unset($_SESSION['message_tag']);
    }
}



//////////////////////// REGULAR FUNCTIONS ///////////////////////////////

// FUNCTION TO REDIRECT AND SET DISPLAY ERROR MESSAGE AND TAG
function redirect($page, $message='', $message_tag='info') {
    $_SESSION['message'] = $message;
    $_SESSION['message_tag'] = $message_tag;
    header("Location: $page");
    die();
}

// FUNCTION TO FORMAT DATE
function format_date($date) {
    return date("d M, Y", strtotime($date));
}

// FUNCTION TO FORMAT DATETIME
function format_datetime($date) {
    return date("d M, Y  H:i A", strtotime($date));
}

// FUNCTION TO GENERATE UNIQUE ID
function generate_unique_id($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // Characters to choose from
    $id = '';

    for ($i = 0; $i < $length; $i++) {
        $id .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $id;
}

// FUNCTION TO VALIDATE AND UPLOAD IMAGES
function handle_image($file, string $folder = '') {
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $response = [];

    if ($file_error === 0) {
        // If no errors
        if ($file_size > 5242880) {
            $response = [
                'status'=>"failed",
                'message'=> "File size is too large. Maximum allowable file size is 2mb"
            ];
        } else {
            // If file size is below size limit

            // Extracting file extension from file name
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            // Setting file extension to lowercase
            $file_extension = strtolower($file_extension);
            // Allowable extensions
            $accepted_extensions = array('jpeg', 'jpg', 'png');

            if (in_array($file_extension, $accepted_extensions)) {
                // If file extension is among accepted extensions

                // Generating a new unique name and appending to the file extension
                $new_file_name = uniqid("IMG-", true).'.'.$file_extension;
                // Defining the upload path
                $image_upload_path = MEDIA_PATH . '/' .  $folder . '/' . $new_file_name;
                // Moving uploaded file to defined upload path
                move_uploaded_file($file_tmp_name, $image_upload_path);
                // Giving positive feedback or response
                $response = [
                    'status'=>"success",
                    'message'=> "Upload successful",
                    'new_file_name'=> $new_file_name
                ];
            } else {
                $response = [
                    'status'=>"failed",
                    'message'=> "Invalid file type"
                ];
            }
        }
    } else {
        $response = [
            'status'=>"failed",
            'message'=> "Unknown error occured"
        ];
    }
    return $response;
}

// FUNCTION TO REORGANISE MULTIPLE $_FILES OBJECTS
function organise_files($files) {

    // New empty array
    $organized_files = array();
    
    foreach ($files as $key => $fileAttributes) {
        foreach ($fileAttributes as $index => $value) {
            $organized_files[$index][$key] = $value;
        }
    }
    
    // Now $organized_files is an array of arrays
    // each representing a single file
    return $organized_files;
}

// FUNCTION TO VALIDATE AND UPLOAD IMAGES
function handle_multiple_image($files, string $folder = '') {
    // Reorganising files
    $files = organise_files($files);
    // Number of files passed
    $total_files = count($files);
    // Default state
    $uploaded_files = [];
    $total_uploaded = 0;

    foreach($files as $file) {
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        

        if ($file_error === 0 && $file_size < 5242880) {
            // If no errors and file size is below size limit (5mb)
    
            // Extracting file extension from file name
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            // Setting file extension to lowercase
            $file_extension = strtolower($file_extension);
            // Allowable extensions
            $accepted_extensions = array('jpeg', 'jpg', 'png');

            if (in_array($file_extension, $accepted_extensions)) {
                // If file extension is among accepted extensions

                // Generating a new unique name and appending to the file extension
                $new_file_name = uniqid("IMG-", true).'.'.$file_extension;
                // Defining the upload path
                $image_upload_path = MEDIA_PATH . '/' . $folder . '/' . $new_file_name;
                // Moving uploaded file to defined upload path
                move_uploaded_file($file_tmp_name, $image_upload_path);
                // Adding new file to uploaded file list
                array_push($uploaded_files, $new_file_name);
                // Increment files uploaded
                $total_uploaded++;
            }

        }
    };

    if ($total_uploaded == $total_files) {
        $response = [
            'status'=>"success",
            'message'=> "All images uploaded successfully",
            'images' => $uploaded_files,
            'total_uploaded'=> $total_uploaded
        ];
    } else if ($total_uploaded > 0 && $total_uploaded < $total_files) {
        $response = [
            'status'=>"partial",
            'message'=> $total_uploaded." out of ".$total_files." images uploaded succesfully",
            'images' => $uploaded_files,
            'total_uploaded'=> $total_uploaded
        ];
    } else if ($total_uploaded == 0) {
        $response = [
            'status'=>"failed",
            'message'=> "No image was uploaded",
            'total_uploaded'=> $total_uploaded
        ];
    }
    return $response;
}

// FUNCTION TO PAGINATE QUERY RESULT
function paginate(string $query, int $results_per_page) {
    // Defining Pagination parameters
    $has_previous = false;
    $has_next = false;
    $previous_page = 1;
    $next_page = 2;
    // Making a query to know how many result of items in table
    $query_items = query_fetch($query); //"SELECT * FROM $table ORDER BY id DESC"
    // Counting the items
    $number_of_results = count($query_items);
    // Determining the number of pages availabe from query results
    // and how many we wish to paginate (passed to the function)
    $number_of_pages = ceil($number_of_results/$results_per_page);
    // Determining current page the user is on
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }
    // Resetting other parameters based on the current page
    if ($page > 1) {
        $has_previous = true;
        $previous_page = $page - 1;
    }
    if ($page < $number_of_pages) {
        $has_next = true;
        $next_page = $page + 1;
    }
    // Determing the sql LIMIT starting number for the results on displaying page
    $this_page_first_result = ($page-1) * $results_per_page;
    // Retrieving selected result from database and displaying them
    $result = query_fetch($query . " LIMIT ". $this_page_first_result . "," . $results_per_page);
    // Returning all pagination results
    return [
        'start'=> 1,
        'page' => $page,
        'result' => $result,
        'has_previous' => $has_previous,
        'previous_page' => $previous_page,
        'has_next' => $has_next,
        'next_page' => $next_page,
        'num_of_pages' => $number_of_pages,
        'end' => $number_of_pages,
        'total' => $number_of_results
    ];
}

// FUNCTION TO FETCH IMAGE
function fetch_image($image, $folder) {
    if ($image == null || !file_exists(APP_PATH . "media/$folder/$image")) {
        // If file does not exist or null
        return STATIC_ROOT . "/no_image.png";
    } else {
        return MEDIA_ROOT . "/$folder/$image";
    }
}

// FUNCTION TO FETCH USERS USING THEIR IDS
function fetch_user(int $id) {
    $matched_users = query_fetch("SELECT * FROM users WHERE id = $id LIMIT 1");

    if (!empty($matched_users)) {
        return $matched_users[0]['username'];
    }
    return "No User";
}

// FUNCTION TO FETCH USERS USING THEIR IDS
function fetchUser(int $id) {
    $matched_users = query_fetch("SELECT * FROM users WHERE id = $id LIMIT 1");

    if (!empty($matched_users)) {
        return $matched_users[0]['fullname'];
    }
    return "No User";
}

// FUNCTION TO FETCH CAR CATEGORIES USING THEIR IDS
function fetch_car_category(int $id) {
    $matched_categories = query_fetch("SELECT * FROM car_categories WHERE id = $id LIMIT 1");

    if (!empty($matched_categories)) {
        return $matched_categories[0]['category'];
    }
    return "Invalid Category";
}

// FUNCTION TO FETCH POST CATEGORIES USING THEIR IDS
function fetch_post_category(int $id) {
    $matched_categories = query_fetch("SELECT * FROM post_categories WHERE id = $id LIMIT 1");

    if (!empty($matched_categories)) {
        return $matched_categories[0]['category'];
    }
    return "Invalid Category";
}

// FUNCTION TO RETURN TOTAL POST OF A CATEGORY
function post_category_total($category_id) {
    $category_id = intval($category_id);
    $total = query_fetch("SELECT COUNT(*) AS category_total FROM posts WHERE category_id = $category_id")[0]['category_total'];
    return $total;
}

// FUNCTION TO FETCH TOTAL COMMENT FOR POST
function post_comments_total($post_id) {
    $post_id = intval($post_id);
    $total = query_fetch("SELECT COUNT(*) AS total_comments FROM comments WHERE post_id = $post_id")[0]['total_comments'];
    return $total;
}

// FUNCTION TO FETCH POSTS USING THEIR IDS
function fetch_post(int $id) {
    $matched_posts = query_fetch("SELECT * FROM posts WHERE id = $id LIMIT 1");

    if (!empty($matched_posts)) {
        return truncate_string($matched_posts[0]['title'], 5);
    }
    return "Invalid Post";
}

// FUNCTION TO SEND MAIL
function send_mail($from, $to, $subject, $message) {
    $mail = new PHPMailer(true);
    try {
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->isHTML(true);

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
        return false;
    }
}

// FUNCTION TO SEND MAIL USING PHP MAILER AND HTML TEMPLATE
function sendMail($to, $subject, $email_values = array()) {

    // Fetching current site settings for email params
    $setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
    // Appending to our passed in array
    $email_values += [
        'site_name'=> ucfirst($setting['name']),
        'site_domain'=> ucfirst($setting['domain']),
        'site_email'=> $setting['email'],
    ];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Set the email configuration
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable debugging if needed
        $mail->isSMTP();
        $mail->Host = EMAIL_HOST; // Update with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USERNAME; // Update with your email
        $mail->Password = EMAIL_PASSWORD; // Update with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use 'tls' or 'ssl' as needed
        $mail->Port = EMAIL_PORT; // Update with your SMTP server port; 587 for gmail

        // Set the sender and recipient
        $mail->setFrom($setting['email'], ucfirst($setting['name'])); // Update with your email and name
        $mail->addAddress($to);

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;

        // Read the HTML template file
        $message = file_get_contents(VIEW_PATH."email_template.html");

        // Replace dynamic values in the template
        foreach ($email_values as $key => $value) {
            $message = str_replace('{{' . $key . '}}', $value, $message);
        }

        $mail->Body = $message;

        // Send the email
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}



////////////////////// PROJECT SPECIFIC FUNCTIONS /////////////////////////////

// FUNCTION TO CHECK IF A NOTIFICATION IS NEW
function check_new(string $date) {
    // Getting current date and timestamp
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $today = $now->getTimestamp();
    // Getting timestamp from param date
    $date = strtotime($date);
    // Calculating days between now and param date
    $days_between = floor(($today - $date) / (60*60*24));
    // Checking if its not up to 2 days
    if ($days_between < 2) {
        // Return true 
        return true;
    }
    return false;
}

// FUNCTION TO DELETE OLD USER NOTIFICATIONS
function delete_old_notifications(int $user_id) {
    $notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id");
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $today = $now->getTimestamp();

    foreach($notifications as $notification) {
        $notification_date = strtotime($notification['date']);
        $days_after_creation = floor(($today - $notification_date) / (60*60*24));

        if ($days_after_creation > 3) {
            $sql = "DELETE FROM notifications WHERE id = :id";
            query_db($sql, ['id'=> $notification['id']]);
        }
    }
}

// FUNCTION TO TRUNCATE WORDS TO CERTAIN LIMIT
function truncate_string($text, $limit) {
    $words = explode(' ', $text);
    if (count($words) > $limit) {
        $truncatedWords = array_slice($words, 0, $limit);
        $truncatedText = implode(' ', $truncatedWords);
        return $truncatedText . '...';
    } else {
        return $text;
    }
}

// FUNCTION TO TRUNCATE HTML CONTENT TO CERTAIN LIMIT
function truncate_HTML($html, $length) {
    // Strip tags, but allow <p> and <a> tags
    //$text = strip_tags($html, '<p><a>');
    $text = strip_tags($html);

    // Truncate the text
    $truncatedText = mb_substr($text, 0, $length);

    // Add ellipsis if the text is truncated
    if (mb_strlen($text) > $length) {
        $truncatedText .= '...';
    }

    return $truncatedText;
}

// FUNCTION TO CREATE SLUG FROM A TEXT
function create_slug($text) {
    // Replace spaces with hyphens
    $slug = str_replace(' ', '-', $text);

    // Remove special characters
    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    // Convert to lowercase
    $slug = strtolower($slug);

    return $slug;
}