<?php

//Products modle//

// Create a function for inserting a new category to the categories table.

function addCategory($categoryName)
{
                //Connect to acme database
                $db   = steeptConnect();
                // The SQL statement
                $sql  = 'INSERT INTO categories (categoryName)
    VALUES (:categoryName)';
                // Create the prepared statement using the acme connection
                $stmt = $db->prepare($sql);
                // The next line will replace the the placeholder in the SQL
                // statement with the actual value in the variable
                // and tells the database it's datatype.
                $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
                // Insert the data
                $stmt->execute();
                // Ask how many rows changed as a result of our insert
                $rowsChanged = $stmt->rowCount();
                // Close the database interaction
                $stmt->closeCursor();
                // Return the indication of success (rows changed)
                return $rowsChanged;
}

// Create a function for inserting a new product to the inventory table.

function addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $categoryId)
{
                //Connect to acme database
                $db   = steeptConnect();
                // The SQL statement
                $sql  = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail, invPrice, invStock, categoryId)
    VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :categoryId)';
                // Create the prepared statement using the acme connection
                $stmt = $db->prepare($sql);
                // The next twelve lines replace the placeholders in the SQL
                // statement with the actual values in the variables
                // and tells the database the type of data it is.
                $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
                $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
                $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
                $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
                $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
                $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
                $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
                // Insert the data
                $stmt->execute();
                // Ask how many rows changed as a result of our insert
                $rowsChanged = $stmt->rowCount();
                // Close the database interaction
                $stmt->closeCursor();
                // Return the indication of success (rows changed)
                return $rowsChanged;
}

// Get products by categoryId 
function getProductsByCategory($categoryId)
{
                $db   = steeptConnect();
                $sql  = ' SELECT * FROM inventory WHERE categoryId = :categoryId';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return $products;
}

// Get product information by invId<>
function getProductInfo($invId)
{
                $db   = steeptConnect();
                $sql  = 'SELECT * FROM inventory WHERE invId = :invId';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
                $stmt->execute();
                $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return $prodInfo;
}

// This function updates a product in the database
function updateProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $categoryId, $invId)
{
                //Connect to acme database
                $db   = steeptConnect();
                // The SQL statement
                $sql  = 'UPDATE inventory SET invName = :invName, 
  invDescription = :invDescription, invImage = :invImage, 
  invThumbnail = :invThumbnail, invPrice = :invPrice, 
  invStock = :invStock, categoryId = :categoryId WHERE invId = :invId';
                // Create the prepared statement using the acme connection
                $stmt = $db->prepare($sql);
                // The next twelve lines replace the placeholders in the SQL
                // statement with the actual values in the variables
                // and tells the database the type of data it is.
                $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
                $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
                $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
                $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
                $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
                $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
                $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
                $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
                // Update the data
                $stmt->execute();
                // Ask how many rows changed as a result of our insert
                $rowsChanged = $stmt->rowCount();
                // Close the database interaction
                $stmt->closeCursor();
                // Return the indication of success (rows changed)
                return $rowsChanged;
}

// This function deletes a product from the database
function deleteProduct($invId)
{
                //Connect to acme database
                $db   = steeptConnect();
                // The SQL statement
                $sql  = 'DELETE FROM inventory WHERE invId = :invId';
                // Create the prepared statement using the acme connection
                $stmt = $db->prepare($sql);
                // Bind invId to the param invId
                $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
                // Delete the data
                $stmt->execute();
                // Ask how many rows changed as a result of our insert
                $rowsChanged = $stmt->rowCount();
                // Close the database interaction
                $stmt->closeCursor();
                // Return the indication of success (rows changed)
                return $rowsChanged;
}

//This function gets a list of products based on the category
function getProductsByCategoryName($categoryName)
{
                $db   = steeptConnect();
                $sql  = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return $products;
}

// This function will get info on a product depending on it's Id
function getProductInfoById($invId)
{
                $db   = steeptConnect();
                $sql  = 'SELECT * FROM inventory WHERE invId = :invId';
                $stmt = $db->prepare($sql);
                $stmt->bindValue('invId', $invId, PDO::PARAM_INT);
                $stmt->execute();
                $productInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return $productInfo;
}

// Get the list of products
function getProductBasics() {
    $db = steeptConnect();
    $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}