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
        redirect("login");
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
function fetch_image($image) {
    if ($image == null || !file_exists(APP_PATH . "media/$image")) {
        // If file does not exist or null
        return STATIC_ROOT . "/no_image.png";
    } else {
        return MEDIA_ROOT . "/$image";
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

// FUNCTION TO SEND MAIL USING PHP MAILER
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

// FUNCTION TO DEBIT OR CREDIT USER BALANCE
function update_account(int $user_id, string $action, $amount) {
    $user = query_fetch("SELECT * FROM users WHERE id = $user_id LIMIT 1")[0];

    if ($action == 'credit') {
        $new_balance = $user['balance'] + $amount;
        // Updating user balance
        $sql = "UPDATE users SET balance = :balance WHERE id = :id LIMIT 1";
        $query = query_db($sql, ['balance'=>$new_balance, 'id'=>$user_id]);
        // Notifying user
        $sql = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
        $query = query_db($sql, ['user_id'=> $user_id, 'message'=>"Your account was credited with $$amount"]);
        return true;
    } else if ($action == 'debit' && $amount <= $user['balance']) {
        $new_balance = $user['balance'] - $amount;
        // Updating user balance
        $sql = "UPDATE users SET balance = :balance WHERE id = :id LIMIT 1";
        $query = query_db($sql, ['balance'=>$new_balance, 'id'=>$user_id]);
        // Notifying user
        $sql = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
        $query = query_db($sql, ['user_id'=> $user_id, 'message'=>"$$amount was debited from your account"]);
        return true;
    }
    return false; // Return false by default
}

// FUNCTION TO UPDATE HANDLE INVESTMENTS
function update_investment(int $user_id) {
    // Fetching running investments
    $investments = query_fetch("SELECT * FROM investments WHERE user_id = $user_id AND status = 'approved'");

    foreach ($investments as $investment) {
        // Getting necessary date and timestamps
        $now = new DateTime('now', new DateTimeZone('UTC'));
        $today = $now->getTimestamp();
        $approved_date = strtotime($investment['approved_date']);
        $end_date = strtotime($investment['end_date']);

        // If today is within investment date
        if ($today < $end_date && $today > $approved_date) {
            $interval = $investment['profit_interval'];
            $days_after_approval = ($today - $approved_date) / (60*60*24);

            if ($days_after_approval >= $interval) {
                // If days after approval equal or greater than profit interval
                // Then calculate the supposed returns for that interval
                $current_interval = floor($days_after_approval / $interval);
                $current_returns = round($investment['profit_per_interval'] * $current_interval, 2);

                // Update investment returns
                if ($investment['returns'] !== $current_returns) {
                    $sql = "UPDATE investments SET returns = :returns WHERE id = :id LIMIT 1";
                    $query = query_db($sql, ['returns'=>$current_returns, 'id'=>$investment['id']]);
                }
            }
        // Else if today is beyond end date of investment
        } else if ($today >= $end_date && $investment['returns'] !== $investment['roi']) {
            // Getting roi
            $roi = $investment['roi'];
            // Completing investment
            $sql = "UPDATE investments SET returns = :returns, status = :status WHERE id = :id LIMIT 1";
            $query = query_db($sql, ['returns'=>$roi, 'status'=>"completed", 'id'=>$investment['id']]);
            // Crediting user
            //update_account($user_id, "credit", $roi);
            // Notifying user
            $sql = "INSERT INTO notifications (user_id, message, date) VALUES (:user_id, :message, :date)";
            $query = query_db($sql, ['user_id'=> $user_id, 'message'=>"Your plan of $".$investment['amount']." has completed successfully and $$roi returned. View plan to reinvest or cashout", 'date'=>$investment['end_date']]);
            // Send Mail if necessary
        }
    }
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