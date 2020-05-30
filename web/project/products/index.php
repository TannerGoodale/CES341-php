<?php
//Products Controller

// Create or access a Session 
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once ('../model/steept-model.php');
// Get the products model for use as needed
require_once '../model/products-model.php';
// Get the functions library
require_once '../library/functions.php';
// Get the uploads model for use as needed
require_once '../model/uploads-model.php';
// Get the reviews model
require_once '../model/reviews-model.php';

// Get the array of categories
$categories = getCategories();

// Create the navList using a function defined in the functions library file
$navList = createNav($categories);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL)
{
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action)
{
    case 'AddCat':
        include('../view/add-category.php');
        break;
    case 'AddProd':
        include('../view/add-product.php');
        break;
    case 'addCat':
        // Filter and store the data
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
        
        // Check for missing data
        if (empty($categoryName))
        {
            $message = '<p class="errorMsg">Please provide the name of the new category.</p>';
            include '../view/add-category.php';
            exit;
        }
        
        // Send the data to the model
        $catOutcome = addCategory($categoryName);
        
        // Check and report the result
        if ($catOutcome === 1)
        {
            header("Location: ../products/index.php");
            exit;
        }
        else
        {
            $message = "<p>Sorry, the category could not be added. Please try again with something else.</p>";
            include('../view/add-category.php');
            exit;
        }
        break;
    case 'addProd':
        // Filter and store the data
        $invName        = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage       = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail   = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice       = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock       = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $categoryId     = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
       
        
        // Validate price using a function from the functions.php library
        $checkedPrice = checkPrice($invPrice);
        
        // Tell the user if the price value was invalid
        if ($checkedPrice == 0)
        {
            $priceMessage = '<p class="errorMsg">Please enter a valid price and provide information for all empty form fields.</p>';
            include '../view/add-product.php';
            exit;
        }
        
        // Check for missing data
        if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($checkedPrice) || empty($invStock) || empty($categoryId))
        {
            $message = '<p class="errorMsg">Please provide information for all empty form fields.</p>';
            include '../view/add-product.php';
            exit;
        }
        
        // Send data to the model for processing
        $prodOutcome = addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $categoryId);
        
        // Check and report the result
        if ($prodOutcome === 1)
        {
            $message = "<p>The new product has been sucessfully added!</p>";
            include('../view/add-product.php');
            exit;
        }
        else
        {
            $message = "<p>Sorry, the category could not be added. Please try again with something else.</p>";
            include('../view/add-product.php');
            exit;
        }
        break;
    
    /* * ********************************** 
     * Get Inventory Items by categoryId 
     * Used for starting Update & delete process 
     * ********************************** */
    case 'getInventoryItems':
        // Get the categoryId 
        $categoryId    = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the products by categoryId from the DB 
        $productsArray = getProductsByCategory($categoryId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($productsArray);
        break;
    
    case 'mod':
        $invId    = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1)
        {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-update.php';
        exit;
        break;
    
    case 'del':
        $invId    = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1)
        {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-delete.php';
        exit;
        break;
    
    case 'updateProd':
        // Filter and store the data
        $invName        = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage       = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail   = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice       = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock       = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $categoryId     = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invId          = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        // Validate price using a function from the functions.php library
        $checkedPrice = checkPrice($invPrice);
        
        // Tell the user if the price value was invalid
        if ($checkedPrice == 0)
        {
            $priceMessage = '<p class="errorMsg">Please enter a valid price and provide information for all empty form fields.</p>';
            include '../view/prod-update.php';
            exit;
        }
        
        // Check for missing data
        if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($checkedPrice) || empty($invStock) || empty($categoryId) || empty($invId))
        {
            $message = '<p class="errorMsg">Please provide information for all empty form fields.</p>';
            include '../view/prod-update.php';
            exit;
        }
        
        // Send data to the model for processing
        $updateResult = updateProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $categoryId, $invId);
        
        // Check and report the result
        if ($updateResult === 1)
        {
            $message             = "<p>The product has been sucessfully updated!</p>";
            $_SESSION['message'] = $message;
            header('location: ../project/products/');
            exit;
        }
        else
        {
            $message = "<p>Sorry, the product could not be updated. Please try again.</p>";
            include('../project/view/prod-update.php');
            exit;
        }
        break;
    
    case 'deleteProd':
        
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invId   = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        $deleteResult = deleteProduct($invId);
        
        if ($deleteResult)
        {
            $message             = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: ../project/products/');
            exit;
        }
        else
        {
            $message             = "<p class='notice'>Error: $invName was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: ../project/products/');
            exit;
        }
        
        break;
    
    case 'category':
        
        $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
        $products     = getProductsByCategoryName($categoryName);
        if (!count($products))
        {
            $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
        }
        else
        {
            $prodDisplay = buildProductsDisplay($products);
        }
        include '../view/category.php';
        
        break;
    
    case 'getProdInfo':
        
        $invId       = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $reviewed = FALSE;

        if ($_SESSION){
            if($_SESSION['loggedin']){
                $clientFirstname = $_SESSION['clientData']['clientfirstname'];
                $clientLastname = $_SESSION['clientData']['clientlastname'];
                $clientId = $_SESSION['clientData']['clientid'];
                // Check to see if a user has an exsisting review on this page.
                $reviewCheck = checkReviewStatus($invId, $clientId);
                if($reviewCheck == TRUE){
                    $reviewed = TRUE;
                }
            }
        }

        $productInfo = getProductInfoById($invId);
        $tnImageInfo = getTnInfo($invId);
        $reviews = getItemReviews($invId);

        if (isset($clientFirstname) && isset($clientLastname)){
        $screenName = screenNameBuild($clientFirstname, $clientLastname);
        }

        if (!count($productInfo))
        {
            $message = "<p class='notice'>Sorry, that product could be not found.</p>";
        }
        else
        {
            $productDisplay = buildProductPageDisplay($productInfo);
            foreach ($productInfo as $data)
            {
                $prodName = $data['invname'];
            }
        }

        if (!count($tnImageInfo))
        {
            $message = "<p>No thumb nail pictures could be found.</p>";
        }
        else
        {
            $tnDisplay = buildTnDisplay($tnImageInfo);
        }

        if (!count($reviews))
        {
            $reviewMessage = "<p class='bump-right'>No reviews exsist for this product yet</p>";
        }
        else
        {
            $rd = buildReviews($reviews);
        }

        if ($_SESSION){
            if (!$_SESSION['loggedin']){
            $preReviewCheck = "<p class='bump-right'>Please <a href='../accounts/index.php?action=Login'>log in</a> if you want to write a review.</p>";
            }elseif($reviewed){
                // var_dump($reviewCheck);
                // exit;
                $preReviewCheck = "<p class='bump-right'>You have already reviewed this product.  Click <a href='../reviews/index.php?action=editReviewView&reviewId=$reviewCheck[reviewId]'>here</a> to edit it.</p>";
            }else{
                //Build a dynamic drop-down select list
                $reviewForm = "<p class='downx2'>Write a review for this product</p>";
                $reviewForm.= "<form class='review-form' action='../reviews/index.php' method='POST'>";
                $reviewForm.= "<h4 class='down'>Writing as $screenName</h4>";
                $reviewForm.= "<textarea name='reviewText' id='reviewText' placeholder='Write a review here...' class='box' required></textarea>";
                $reviewForm.= "<input name='submit' type='submit' value='Submit Review' class='submitBtn'>";
                //Add the action key-value pair
                $reviewForm.= "<input type='hidden' name='action' value='addReview'>";
    
                $reviewForm.= "<input type='hidden' name='invId' value='$invId'>";
    
                //Define clientId
                $clientId = $_SESSION['clientData']['clientid'];
    
                $reviewForm.= "<input type='hidden' name='clientId' value='$clientId'>";
                $reviewForm.= '</form>';
    
            }
        }else{
            $preReviewCheck = "<p class='bump-right'>Please <a href='../accounts/index.php?action=Login'>log in</a> if you want to write a review.</p>";
        }

        include '../project/view/product-detail.php';
        
        break;
    
    default:
        $categoryList = buildCategoryList($categories);
        
        
        include('../project/view/product-management.php');
        break;
}

?>