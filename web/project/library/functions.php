<?php

// This file will be used to store functions for use across different controllers

// Email validation
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Password validation
// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
   }

// Price validation
function checkPrice($invPrice){
    $pattern = '/^\d+(\.\d{2})?$/';
    return preg_match($pattern, $invPrice);
}

 function createNav($categories){
    // Build a navigation bar using the $categories array
    $navList = '<ul>';
    $navList .= "<li><a href='http://cryptic-sands-03658.herokuapp.com/project/' title='Go to SteeptClub home page'>Home</a></li>";
    foreach ($categories as $category) {
    $navList .= "<li><a href='http://cryptic-sands-03658.herokuapp.com/project/products/?action=category&categoryName=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
 }

 // Build the categories select list 
function buildCategoryList($categories){ 
    $catList = '<select name="categoryId" id="categoryList">'; 
    $catList .= "<option>Choose a Category</option>"; 
    foreach ($categories as $category) { 
     $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>"; 
    } 
    $catList .= '</select>'; 
    return $catList; 
   }


// Build a dispaly of products within an unordered list
function buildProductsDisplay($products){
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
     $pd .= '<li>';
     $pd .= "<a href='http://cryptic-sands-03658.herokuapp.com/project/products/index.php?action=getProdInfo&invId=$product[invId]'><img src='$product[invThumbnail]' alt='Image of $product[invName] on SteeptClub.com'></a>";
     $pd .= '<hr>';
     $pd .= "<a href='http://cryptic-sands-03658.herokuapp.com/project/products/index.php?action=getProdInfo&invId=$product[invId]'><h2>$product[invName]</h2></a>";
     $pd .= "<span>$$product[invPrice]</span>";
     $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
   }

// Build a display for a product in HTML5
function buildProductPageDisplay($productInfo){

    $prod = "<div class='prodMain'>";
    foreach ($productInfo as $data) {
    $prod .= "<h1>$data[invName]</h1>";
    $prod .= "<img src='$data[invImage]' alt='$data[invName]'>";
    $prod .= "</div>";
    $prod .= '<div class="prodInfo">';
    $prod .= "<p>$data[invDescription]</p>";
    $prod .= "<p>Number in stock: $data[invStock]</p>";
    $prod .= "<h2 class='red'>$$data[invPrice]</h2>";
    $prod .= "</div>";
    }

    return $prod;
}

/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
   }

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invName] image on SteeptClub.com' alt='$image[invName] image on SteeptClub.com'>";
     $id .= "<p><a href='http://cryptic-sands-03658.herokuapp.com/project/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
   }

// Build the products select list
function buildProductsSelect($products) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Product</option>";
    foreach ($products as $product) {
     $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
   }

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
   }

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the resizeImage function
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
   } // ends the if - else began on line 36

// Builder function for thumb nail images
function buildTnDisplay($tnImageInfo){

    $id = '<ul id="tnImage-display">';
    foreach ($tnImageInfo as $tnImage) {
     $id .= '<li>';
     $id .= "<img src='$tnImage[imgPath]' title='$tnImage[imgName] image on SteeptClub.com' alt='$tnImage[imgName] image on SteeptClub.com'>";
     $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;

}


/* * ********************************
*  Functions for working with reviews
* ********************************* */

// Create screen name dynamicly for each client
function screenNameBuild($clientFirstname, $clientLastname) {
    $firstLetter = substr($clientFirstname, 0, 1);
    $screenName = "$firstLetter$clientLastname";
    return $screenName;
}

// Builder function for review layout(s)
function buildReviews($reviews) {
    $rd = '<div>';
    foreach ($reviews as $activeReview) {
        // Define data for the loop
        $reviewId = $activeReview['reviewId'];
        $reviewText = $activeReview['reviewText'];
        $invName = $activeReview['invName'];
        $reviewDate = date("F jS, Y", strtotime($activeReview['reviewDate']));
        $clientFirstname = $activeReview['clientFirstname'];
        $clientLastname = $activeReview['clientLastname'];
        $screenName = screenNameBuild($clientFirstname, $clientLastname);
        // Build the body using defined data
        $rd .= '<div class="review-block">';
        $rd .= "<h5 class='screen-name'>-$screenName</h5>";
        $rd .= "<h6 class='date'>Review written: $reviewDate</h6>";
        $rd .= "<p class='review-text'>\"$reviewText\"</p>";
        $rd .= "<input type='hidden' name='invId' value='$reviewId'>";
        $rd .= '</div>';
        }
    $rd .= '</div>';
    return $rd;
}

// Builder function for dynamic reviews
function buildFormReviews($reviews) {
    $rd = '<div>';
    foreach ($reviews as $activeReview) {
        // Define data for the loop
        $reviewId = $activeReview['reviewId'];
        $reviewText = $activeReview['reviewText'];
        $reviewDate = date("F jS, Y", strtotime($activeReview['reviewDate']));
        $invName = $activeReview['invName'];
        $clientFirstname = $activeReview['clientFirstname'];
        $clientLastname = $activeReview['clientLastname'];
        $screenName = screenNameBuild($clientFirstname, $clientLastname);
        // Build the body using defined data
        $rd .= '<div class="review-block">';
        $rd .= "<h5 class='screen-name'>-$screenName</h5>";
        $rd .= "<h6 class='date'>Review written: $reviewDate</h6>";
        $rd .= "<h5 class='item-name'>Review of: $invName</h5>";
        $rd .= "<p class='review-text'>\"$reviewText\"</p>";
         $rd .= "<form action='http://cryptic-sands-03658.herokuapp.com/project/reviews/index.php' method='GET'>";
         $rd .= "<input type='hidden' name='reviewId' value='$reviewId'>";
         $rd .= "<input type='hidden' name='action' value='editReviewView'>";
         $rd .= "<input name='submit' type='submit' value='Edit Review' class='submitBtn'>";
         $rd .= "</form>";
         $rd .= "<form action='http://cryptic-sands-03658.herokuapp.com/project/reviews/index.php' method='GET'>";
         $rd .= "<input type='hidden' name='reviewId' value='$reviewId'>";
         $rd .= "<input type='hidden' name='action' value='deleteReviewView'>";
         $rd .= "<input name='submit' type='submit' value='Delete Review' class='submitBtn'>";
         $rd .= "</form>";
        $rd .= '</div>';
        }
    $rd .= '</div>';
    return $rd;
}

// Builder function for modifying review
function buildEditForm($review) {
    // Define data into variables
    $reviewId = $review['reviewId'];
    $reviewText = $review['reviewText'];
    $invName = $review['invName'];
    $reviewDate = date("F jS, Y", strtotime($review['reviewDate']));
    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $clientLastname = $_SESSION['clientData']['clientLastname'];
    $screenName = screenNameBuild($clientFirstname, $clientLastname);
    // Build structure for review form
    $rd = '<div class="review-block">';
    $rd .= "<h5 class='screen-name'>-$screenName</h5>";
    $rd .= "<h6 class='date'>Review written: $reviewDate</h6>";
    $rd .= "<h5 class='item-name'>Review of: $invName</h5>";
    $rd .= "<form action='http://cryptic-sands-03658.herokuapp.com/project/reviews/index.php' method='POST'>";
    $rd .= "<textarea name='reviewText' id='reviewText' rows='4' cols='50' required>$reviewText</textarea>";
    $rd .= "<input type='hidden' name='reviewId' value='$reviewId'>";
    $rd .= "<input type='hidden' name='action' value='reviewUpdate'>";
    $rd .= "<input name='submit' type='submit' value='Submit Edit' class='submitBtn'>";
    $rd .= "</form>";
        $rd .= "<form action='http://cryptic-sands-03658.herokuapp.com/project/reviews/index.php' method='GET'>";
         $rd .= "<input type='hidden' name='reviewId' value='$reviewId'>";
         $rd .= "<input type='hidden' name='action' value='deleteReviewView'>";
         $rd .= "<input name='submit' type='submit' value='Delete Review' class='submitBtn'>";
         $rd .= "</form>";
    $rd .= "<form action='http://cryptic-sands-03658.herokuapp.com/project/reviews/index.php' method='POST'>";
    $rd .= "<input type='hidden' name='action' value='cancel'>";
    $rd .= "<input name='submit' type='submit' value='Cancel' class='submitBtn'>";
    $rd .= "</form>";
    $rd .= "</div>";
    return $rd;
}

    // Builder function for modifying review
function buildDeleteForm($review) {
    // Define data into variables
    $reviewId = $review['reviewId'];
    $reviewText = $review['reviewText'];
    $invName = $review['invName'];
    $reviewDate = date("F jS, Y", strtotime($review['reviewDate']));
    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $clientLastname = $_SESSION['clientData']['clientLastname'];
    $screenName = screenNameBuild($clientFirstname, $clientLastname);
    // Build structure for review form
    $rd = '<div class="review-block">';
    $rd .= "<h5 class='screen-name'>-$screenName</h5>";
    $rd .= "<h6 class='date'>Review written: $reviewDate</h6>";
    $rd .= "<h5 class='item-name'>Review of: $invName</h5>";
    $rd .= "<form action='http://cryptic-sands-03658.herokuapp.com/project/reviews/index.php' method='POST'>";
    $rd .= "<p class='review-text'>\"$reviewText\"</p>";
    $rd .= "<input type='hidden' name='reviewId' value='$reviewId'>";
    $rd .= "<input type='hidden' name='action' value='deleteReview'>";
    $rd .= "<input name='submit' type='submit' value='Confirm Delete' class='submitBtn'>";
    $rd .= "</form>";
        $rd .= "<form action='http://cryptic-sands-03658.herokuapp.com/project/reviews/index.php' method='GET'>";
        $rd .= "<input type='hidden' name='reviewId' value='$reviewId'>";
        $rd .= "<input type='hidden' name='action' value='editReviewView'>";
        $rd .= "<input name='submit' type='submit' value='Edit Review' class='submitBtn'>";
        $rd .= "</form>";
    $rd .= "<form action='http://cryptic-sands-03658.herokuapp.com/project/reviews/index.php' method='POST'>";
    $rd .= "<input type='hidden' name='action' value='cancel'>";
    $rd .= "<input name='submit' type='submit' value='Cancel' class='submitBtn'>";
    $rd .= "</form>";
    $rd .= "</div>";
    return $rd;
}