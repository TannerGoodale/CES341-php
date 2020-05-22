<?php

//Products modle//

// Create a function for inserting a new category to the categories table.

function addCategory($categoryName)
{
                //Connect to acme database
                $db   = steeptConnect();
                // The SQL statement
                $sql  = 'INSERT INTO categories (categoryname)
    VALUES (:categoryname)';
                // Create the prepared statement using the acme connection
                $stmt = $db->prepare($sql);
                // The next line will replace the the placeholder in the SQL
                // statement with the actual value in the variable
                // and tells the database it's datatype.
                $stmt->bindValue(':categoryname', $categoryName, PDO::PARAM_STR);
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
                $sql  = 'INSERT INTO inventory (invname, invdescription, invimage, invthumbnail, invprice, invstock, categoryid)
    VALUES (:invname, :invdescription, :invimage, :invthumbnail, :invprice, :invstock, :categoryid)';
                // Create the prepared statement using the acme connection
                $stmt = $db->prepare($sql);
                // The next twelve lines replace the placeholders in the SQL
                // statement with the actual values in the variables
                // and tells the database the type of data it is.
                $stmt->bindValue(':invname', $invName, PDO::PARAM_STR);
                $stmt->bindValue(':invdescription', $invDescription, PDO::PARAM_STR);
                $stmt->bindValue(':invimage', $invImage, PDO::PARAM_STR);
                $stmt->bindValue(':invthumbnail', $invThumbnail, PDO::PARAM_STR);
                $stmt->bindValue(':invprice', $invPrice, PDO::PARAM_STR);
                $stmt->bindValue(':invstock', $invStock, PDO::PARAM_INT);
                $stmt->bindValue(':categoryid', $categoryId, PDO::PARAM_INT);
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
                $sql  = ' SELECT * FROM inventory WHERE categoryid = :categoryid';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':categoryid', $categoryId, PDO::PARAM_INT);
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return $products;
}

// Get product information by invId<>
function getProductInfo($invId)
{
                $db   = steeptConnect();
                $sql  = 'SELECT * FROM inventory WHERE invid = :invid';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
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
                $sql  = 'UPDATE inventory SET invname = :invname, 
  invdescription = :invdescription, invimage = :invimage, 
  invthumbnail = :invrhumbnail, invprice = :invprice, 
  invstock = :invstock, categoryid = :categoryid WHERE invid = :invid';
                // Create the prepared statement using the acme connection
                $stmt = $db->prepare($sql);
                // The next twelve lines replace the placeholders in the SQL
                // statement with the actual values in the variables
                // and tells the database the type of data it is.
                $stmt->bindValue(':invname', $invName, PDO::PARAM_STR);
                $stmt->bindValue(':invdescription', $invDescription, PDO::PARAM_STR);
                $stmt->bindValue(':invimage', $invImage, PDO::PARAM_STR);
                $stmt->bindValue(':invthumbnail', $invThumbnail, PDO::PARAM_STR);
                $stmt->bindValue(':invprice', $invPrice, PDO::PARAM_STR);
                $stmt->bindValue(':invstock', $invStock, PDO::PARAM_INT);
                $stmt->bindValue(':categoryid', $categoryId, PDO::PARAM_INT);
                $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
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
                $sql  = 'DELETE FROM inventory WHERE invid = :invid';
                // Create the prepared statement using the acme connection
                $stmt = $db->prepare($sql);
                // Bind invId to the param invId
                $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
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
                $sql  = 'SELECT * FROM inventory WHERE categoryid IN (SELECT categoryid FROM categories WHERE categoryname = :categoryname)';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':categoryname', $categoryName, PDO::PARAM_STR);
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return $products;
}

// This function will get info on a product depending on it's Id
function getProductInfoById($invId)
{
                $db   = steeptConnect();
                $sql  = 'SELECT * FROM inventory WHERE invid = :invid';
                $stmt = $db->prepare($sql);
                $stmt->bindValue('invid', $invId, PDO::PARAM_INT);
                $stmt->execute();
                $productInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return $productInfo;
}

// Get the list of products
function getProductBasics() {
    $db = steeptConnect();
    $sql = 'SELECT invname, invid FROM inventory ORDER BY invname ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}