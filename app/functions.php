<?php

//////////////////////// AUTH FUNCTIONS ///////////////////////////////

// FUNCTIONS RETURNS USER DATA IF AUTHENTICATED OR FALSE IS UNAUTHENTICATED
// NOTE THIS FUNCTION DOES NOT REDIRECT OR AUTHORIZE USERS
function is_user_authenticated() {
    if (isset($_SESSION['user_id'])) {
        // Getting the user id value stored in the session
        $user_id = intval($_SESSION['user_id']);

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
    // return false by default
    return false;
}

// FUNCTION REDIRECT USERS TO LOGIN PAGE IF NOT AUTHENTICATED
function logged_in() {
    $user = is_user_authenticated();
    // This function depends on is_user_authenticated() function
    if (!$user) {
        header('Location: login.php');
        die();
    } else {
        return $user;
    }
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
    if (!file_exists(APP_PATH . "templates/landing/layout.php")
    || !file_exists(APP_PATH . "templates/landing/$name.view.php"))
    {
        // Returning 404 Page if view not found
        require(APP_PATH . "404.php");
    } else {
        // Note that other included file path inside of this
        // layout.php is relative to this layout.php's file path 
        require(APP_PATH . "templates/landing/layout.php");
    }

    // Unset message after view has loaded
    unset_message();
}

// DASHBOARD VIEW FUNCTION
function dashboard_view($name, $context=[]) {
    if (!file_exists(APP_PATH . "templates/dashboard/layout.php")
    || !file_exists(APP_PATH . "templates/dashboard/$name.view.php"))
    {
        // Returning 404 Page if view not found
        require(APP_PATH . "404.php");
    } else {
        // Note that other included file path inside of this
        // layout.php is relative to this layout.php's file path 
        require(APP_PATH . "templates/dashboard/layout.php");
    }

    // Unset message after view has loaded
    unset_message();
}

// ADMIN VIEW FUNCTION
function admin_view($name, $context=[]) {
    if (!file_exists(APP_PATH . "templates/admin/layout.php")
    || !file_exists(APP_PATH . "templates/admin/$name.view.php"))
    {
        // Returning 404 Page if view not found
        require(APP_PATH . "404.php");
    } else {
        // Note that other included file path inside of this
        // layout.php is relative to this layout.php's file path 
        require(APP_PATH . "templates/admin/layout.php");
    }

    // Unset message after view has loaded
    unset_message();
}


//////////////////////// OTHER FUNCTIONS ///////////////////////////////

// FUNCTION TO UNSET MESSAGE AND MESSAGE TAGS
// FUNCTION TO RUN AFTER EACH PAGE RENDERS
function unset_message() {
    // Resetting messages after each view has been displayed
    if (isset($_SESSION['message'])) {
        unset($_SESSION['message']);
    }

    if (isset($_SESSION['message_tag'])) {
        unset($_SESSION['message_tag']);
    }
}

// FUNCTION TO REDIRECT AND SET DISPLAY ERROR MESSAGE AND TAG
function redirect($page, $message='', $message_tag='info') {
    $_SESSION['message'] = $message;
    $_SESSION['message_tag'] = $message_tag;
    header("Location: $page.php");
    die();
}

// GENERALIZED REDIRECT FUNCTION
function redirect_to($page, $message='', $message_tag='info') {
    $_SESSION['message'] = $message;
    $_SESSION['message_tag'] = $message_tag;
    header("Location: $page");
    die();
}

// FUNCTION TO VALIDATE AND UPLOAD IMAGES
function handle_image($file) {
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $response = [];

    if ($file_error === 0) {
        // If no errors
        if ($file_size > 2097152) {
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
                $image_upload_path = MEDIA_PATH . $new_file_name;
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
function get_image($image) {
    if ($image == null || !file_exists(APP_PATH . "media/$image")) {
        // If file does not exist or null
        return STATIC_ROOT . "no_image.png";
    } else {
        return MEDIA_ROOT . $image;
    }
    
}

// FUNCTION TO SEND MAIL
function send_mail($from, $to, $subject, $message) {
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    if (mail($to, $subject, $message, $headers)) {
        return true;
    }
    return false;
}