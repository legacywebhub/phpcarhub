<?php

// Authorize user
$admin = logged_in();

// Redirecting user if id not provided
if (!isset($_GET['id'])) {
    redirect('messages');
}

// Deleting message
$message_id = intval($_GET['id']);
query_fetch("DELETE FROM messages WHERE id = $message_id");
redirect('messages');