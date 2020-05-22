<?php
//Steept Controller

// Create or access a Session 
session_start();

try{
    
// Get the database connection file
require_once ('library/connections.php');
// Get the acme model for use as needed
require_once ('model/acme-model.php');
// Get the functions library
require_once ('library/functions.php');

    }
     catch (Exception $ex) {
        echo "ERROR: $ex";
    }


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
        include ('view/home.php');
        break;
    
    default:
        include ('view/home.php');
}

?>
