<?php

// Reviews Controller

// Create or access a Session 
session_start();

// Grab libraries and models
require_once '../library/connections.php';
require_once '../model/steept-model.php';
require_once '../model/products-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';

// Get the array of categories
$categories = getCategories();

// Create the navList using a function defined in the functions library file
$navList = createNav($categories);

// Grab the 'action' name and it's value from the url
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if ($action == NULL){

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

}

// Format a switch statement to take the values from action and apply action
switch ($action) {
// Add a new review
case 'addReview':

    // Store incoming data into variables
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_VALIDATE_INT);

    // Make sure no values are empty
    if (empty($reviewText) || empty($invId) || empty($clientId)){
        $reviewMessage = "<p class='errorMsg'>Something went wrong, you've been sent to this page to reset your user data.  Please try your review again.  Make sure JavaScript is enabled on your computer! </p>";
        include '../accounts/index.php';
        exit;
    }

    // Send data to the model for proccessing
    $result = addReview($reviewText, $invId, $clientId);

    $reviews = getClientReviews($clientId);

    if($reviews == TRUE){
        $_SESSION['message'] = "<p class='bump-right red'>Thank you for adding your review</p>";
    }
    
    // Take array and put it through a builder function
    $results = buildFormReviews($reviews);

    header ("../products/index.php?action=getProdInfo&invId=$invId");

break;
// Deliver a view to edit a review
case 'editReviewView':

    // Get the parameters to select proper review
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    // Get the selected review with the proper model function
    $review = getReview($reviewId);

    //var_dump($review);
    //exit;

    // Take array and put it through a builder function
    $reviewDisplay = buildEditForm($review);

    // Display the review for editing
    include '../view/update-review.php';

break;
// Handle the review update
case 'reviewUpdate':

    //Get the paameters to update review
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    // Create backup display for table if error
    $review = getReview($reviewId);
    $reviewDisplay = buildEditForm($review);
    if (empty($reviewText) || empty($reviewId)){
        $message = "<p>Please add text to your review.</p>";
        include '../project/view/update-review.php';
        exit;
    }

    // Update review by running the data through the model
    $upResults = updateReview($reviewText, $reviewId);

    //Verify that the update worked
    if ($upResults == 1) {
        $_SESSION['reviewMessage'] = "<p class='bump-right red'>Your review was updated!<p>";
        header("Location: ../project/accounts/index.php");
        exit;
    }else{
        $message = "<p class='bump-right red'>Something went wrong, please try again</p>";
        include '../project/view/update-review.php';
        exit;
    }

break;
// Deliver a view to confirm deletion of a review
case 'deleteReviewView':

     // Get the parameters to select proper review
     $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

     // Get the selected review with the proper model function
     $review = getReview($reviewId);
 
     //var_dump($review);
     //exit;
 
     // Take array and put it through a builder function
     $reviewDisplay = buildDeleteForm($review);
 
     // Display the review for editing
     include '../project/view/delete-review.php';

break;
// Handle the review deletion
case 'deleteReview':

    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    if(empty($reviewId)){
        include '../project/view/500.php';
    }

    $reviewResults = deleteReview($reviewId);

    if ($reviewResults == 1) {
        $_SESSION['reviewMessage'] = "<p class='bump-right red'>Your review was deleted.<p>";
        header("Location: ../project/accounts/index.php");
        exit;
    }

break;
//Send people back to the admin page if they click cancel
case 'cancel':
    header("Location: ../project/accounts/index.php");
break;
// Deliver the "admin" view (admin.php has built in functionality to redirect to the home page if a user is not logged in)
default:

header("Location: ../project/accounts/index.php");

break;
}
?>