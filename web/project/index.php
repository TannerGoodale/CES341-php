<?php
//Acme Controller

//Root links will start with this string, "http://cryptic-sands-03658.herokuapp.com/"

// Create or access a Session 
session_start();

// Get the database connection file
include ('/project/library/connections.php');
// Get the acme model for use as needed
include ('/project/model/acme-model.php');
// Get the functions library
include ('/project/library/functions.php');


// Get the array of categories
$categories = getCategories();

// Create the navList using a function defined in the functions library file
$navList = createNav($categories);

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'Home':
        include 'project/view/home.php';
        break;
    
    default:
        include 'project/view/home.php';
}

?>
