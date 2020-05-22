<?php

// Model for interacting with the reviews table in the acme database

// Insert a review
function addReview($reviewText, $invId, $clientId) {
    $db = steeptConnect();
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
   }

// Get reviews for a specific inventory item
function getItemReviews($invId) {
    $db = steeptConnect();
    // Needed data: Client first name, client last name, review text, review date.
    // Data is spread through multiple tables.  Use join on clients table to get full data array.
    $sql = 'SELECT reviewId, reviewText, reviewDate, clients.clientFirstname, clients.clientLastname, inventory.invName FROM reviews JOIN clients ON reviews.clientId = clients.clientId JOIN inventory ON inventory.invId = reviews.invId WHERE reviews.invId = :invId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}

// Get reviews written by a specific client
function getClientReviews($clientId) {
    $db = steeptConnect();
    // Needed data: Client first name, client last name, review text, review date.
    // Data is spread through multiple tables.  Use join on clients table to get full data array.
    $sql = 'SELECT reviewId, reviewText, reviewDate, clients.clientFirstname, clients.clientLastname, inventory.invName FROM reviews JOIN clients ON reviews.clientId = clients.clientId JOIN inventory ON inventory.invId = reviews.invId WHERE reviews.clientId = :clientId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}

// Get reviews written by a specific client
function getReview($reviewId) {
    $db = steeptConnect();
    // Needed data: Client first name, client last name, review text, review date.
    // Data is spread through multiple tables.  Use join on clients table to get full data array.
    $sql = 'SELECT reviewId, reviewText, reviewDate, inventory.invName FROM reviews JOIN inventory ON inventory.invId = reviews.invId WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

// Check to see if a client has made a review for a product.  If so, prevent them from being able to write another review.
function checkReviewStatus($invId, $clientId) {
    $db = steeptConnect();
    $sql = 'SELECT reviewId FROM reviews WHERE invId = :invId AND clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

// Update a specific review
function updateReview($reviewText, $reviewId) {
     $db = steeptConnect();
     $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
     $stmt = $db->prepare($sql);
     $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
     $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
     $stmt->execute();
     $rowsChanged = $stmt->rowCount();
     $stmt->closeCursor();
     return $rowsChanged;
}

// Delete a specific review
function deleteReview($reviewId) {
    $db = steeptConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
?>