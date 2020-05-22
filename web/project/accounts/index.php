<?php
//Accounts Controller

error_reporting(E_ERROR | E_WARNING | E_PARSE);

 // Create or access a Session
 session_start();
 

// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once ('../model/steept-model.php');
// Get the accounts model for use as needed
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';
// Get the reviews model
require_once '../model/reviews-model.php';

// Get the array of categories
$categories = getCategories();

//var_dump($categories);
//exit;

// Build a navigation bar using the $categories array
/*$navList = '<ul>';
$navList .= "<li><a href='../index.php' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {
 $navList .= "<li><a href='../index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= '</ul>';
*/

// Create the navList using a function defined in the functions library file
$navList = createNav($categories);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
    case 'Login':
     include ('../view/login.php');
     break;
    case 'Registration':
     include ('../view/registration.php');
     break;
    case 'register':
     // Filter and store the data
      $clientFirstName = filter_input(INPUT_POST, 'clientFirstName', FILTER_SANITIZE_STRING);
      $clientLastName = filter_input(INPUT_POST, 'clientLastName', FILTER_SANITIZE_STRING);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

      // Validate email on server side using validation function
      $clientEmail = checkEmail($clientEmail);

      // Validate password on server side using validation function
      $checkPassword = checkPassword($clientPassword);

      // Check to see if email has already been used
      $existingEmail = checkExistingEmail($clientEmail);

      if($existingEmail){
         $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
         include '../view/login.php';
         exit;
        }

      // Check for missing data
      if(empty($clientFirstName) || empty($clientLastName) || empty($clientEmail) || empty($checkPassword)){
         $message = '<p class="errorMsg">Please provide information for all empty form fields.</p>';
         include '../view/registration.php';
         exit; 
      }

      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

      // Send the data to the model
      $regOutcome = regClient($clientFirstName, $clientLastName, $clientEmail, $hashedPassword);

     // Check and report the result
      if($regOutcome === 1){
         setcookie('firstname', $clientFirstName, strtotime('+1 year'), '/');
         $message = "<p>Thanks for registering $clientFirstName. Please use your email and password to login.</p>";
         include ('../view/login.php');
         exit;
      } else {
         $message = "<p>Sorry $clientFirstName, but the registration failed. Please try again.</p>";
         include ('../view/registration.php');
         exit;
      }
      break;
    case 'updateUser':

      include '../view/client-update.php';

      break;
    case 'updateUserInfo':

      // Filter and store the data
      $clientFirstName = filter_input(INPUT_POST, 'clientFirstName', FILTER_SANITIZE_STRING);
      $clientLastName = filter_input(INPUT_POST, 'clientLastName', FILTER_SANITIZE_STRING);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

      // Validate email on server side using validation function
      $clientEmail = checkEmail($clientEmail);
      

      // Check to see if email has already been used
      if($clientEmail != $_SESSION['clientData']['clientemail']){
      $existingEmail = checkExistingEmail($clientEmail);
      if($existingEmail){
         $message = '<p class="notice">That email address already exists. Please try a different one.</p>';
         include '../view/client-update.php';
         exit;
        }
      }

      // Check for missing data
      if(empty($clientFirstName) || empty($clientLastName) || empty($clientEmail)){
         $message = '<p class="errorMsg">Please provide information for all empty form fields.</p>';
         include '../view/client-update.php';
         exit; 
        }

      // Send data to the model for data base processing
      $updateResult = updateUserInfo($clientFirstName, $clientLastName, $clientEmail, $clientId);

      if ($updateResult === 1) {
         $message = "<p>Your info has been sucessfully updated!</p>";
         $_SESSION['message'] = $message;
      } else {
         $message = "<p>Sorry, your user info could not be updated. Please try again.</p>";
         $_SESSION['message'] = $message;
         header('Location: ../accounts/');
      }

      // Get client info through the clientId and update the session
      $newClientData = getClientById($clientId);

      // the array_pop function removes the last
      // element from an array
      array_pop($newClientData);
      // Store the array into the session
      $_SESSION['clientData'] = $newClientData;
      // Send them to the admin view

      include '../view/admin.php';

      break;

    case 'updatePassword':

      // Filter and store the data
      $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

      // Validate password on server side using validation function
      $checkPassword = checkPassword($clientPassword);

      // Check for missing data
      if(empty($checkPassword)){
         $pErrorMessage = '<p class="errorMsg">We were unable to update your password, please make sure it is to standard</p>';
         $_SESSION['pErrorMessage'] = $pErrorMessage;
         include '../view/client-update.php';
         exit; 
      }

      // Hash the checked password
      $hashUpdatedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
      // Update the password in the data base
      $passUpOutCome = passwordUpdate($hashUpdatedPassword, $clientId);
      // Check for success or failure
      if ($passUpOutCome) {
         $message = "<p>Your password has been sucessfully updated!</p>";
         $_SESSION['message'] = $message;
         include '../view/admin.php';
      } else {
         $message = "<p>Sorry, your password could not be updated. Please try again.</p>";
         $_SESSION['message'] = $message;
         include '../view/admin.php';
      }


      break;
    case 'login':

      // Filter and store the data
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

      // Validate email on server side using validation function
      $clientEmail = checkEmail($clientEmail);

      // Validate password on server side using validation function
      $checkPassword = checkPassword($clientPassword);

      // Check for missing data
      if(empty($clientEmail) || empty($checkPassword)){
         $message = '<p>Please provide information for all empty form fields.</p>';
         include '../view/login.php';
         exit; 
      }

      // A valid password exists, proceed with the login process
      // Query the client data based on the email address
      $clientData = getClient($clientEmail);
      // Compare the password just submitted against
      // the hashed password for the matching client
      $hashCheck = password_verify($clientPassword, $clientData['clientpassword']);
      // If the hashes don't match create an error
      // and return to the login view
      if (!$hashCheck) {
      $message = '<p class="notice">Please check your password and try again.</p>';
      include '../view/login.php';
      exit; 
      }

      // A valid user exists, log them in
      $_SESSION['loggedin'] = TRUE;
      // Remove the password from the array
      // the array_pop function removes the last
      // element from an array
      array_pop($clientData);
      // Store the array into the session
      $_SESSION['clientData'] = $clientData;
      // Send them to the admin view

      // Form text fields for the advanced users
      $advancedMessage = '<p>Use the link below to manage products</p>';
      $advancedMessage .= '<p><a href="../products/">Product Management</a></p>';

      $clientId = $_SESSION['clientData']['clientid'];

      $reviews = getClientReviews($clientId);
 
      // Take array and put it through a builder function
      $results = buildFormReviews($reviews);

      // Set the cookie to have the current user's first name displayed.
      // Check if the firstname cookie exists, get its value

      setcookie("firstname", '$_SESSION["clientData"]["clientfirstname"]', time() -360000, "/");
      
      include '../view/admin.php';
      exit;
          
    break;
    case 'logout':
      session_destroy();
      header("Location: ../index.php");
    break;
    default:
    
     $clientId = $_SESSION['clientData']['clientid'];

     $reviews = getClientReviews($clientId);

     // Take array and put it through a builder function
     $results = buildFormReviews($reviews);

     include ('../view/admin.php');
   }

?>