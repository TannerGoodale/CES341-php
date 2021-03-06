<?php

// Model for interacting with the reviews table in the acme database

// Insert a review
function addReview($reviewText, $invId, $clientId) {
    $db = steeptConnect();
    $sql = 'INSERT INTO reviews (reviewtext, invid, reviewdate, clientid) VALUES (:reviewtext, :invid, CURRENT_TIMESTAMP, :clientid)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewtext', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientid', $clientId, PDO::PARAM_INT);
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
    $sql = 'SELECT reviewid, reviewtext, reviewdate, clients.clientfirstname, clients.clientlastname, inventory.invname FROM reviews JOIN clients ON reviews.clientid = clients.clientid JOIN inventory ON inventory.invid = reviews.invid WHERE reviews.invid = :invid ORDER BY reviewdate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
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
    $sql = 'SELECT reviewid, reviewtext, reviewdate, clients.clientfirstname, clients.clientlastname, inventory.invname FROM reviews JOIN clients ON reviews.clientid = clients.clientid JOIN inventory ON inventory.invid = reviews.invid WHERE reviews.clientid = :clientid ORDER BY reviewdate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientid', $clientId, PDO::PARAM_INT);
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
    $sql = 'SELECT reviewid, reviewtext, reviewdate, inventory.invname FROM reviews JOIN inventory ON inventory.invid = reviews.invid WHERE reviewid = :reviewid';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewid', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

// Check to see if a client has made a review for a product.  If so, prevent them from being able to write another review.
function checkReviewStatus($invId, $clientId) {
    $db = steeptConnect();
    $sql = 'SELECT reviewid FROM reviews WHERE invid = :invid AND clientid = :clientid';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientid', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

// Update a specific review
function updateReview($reviewText, $reviewId) {
     $db = steeptConnect();
     $sql = 'UPDATE reviews SET reviewtext = :reviewText WHERE reviewid = :reviewId';
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
    $sql = 'DELETE FROM reviews WHERE reviewid = :reviewid';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewid', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
?>