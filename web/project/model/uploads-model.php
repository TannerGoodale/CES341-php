<?php

// The model for image interactions on the database

// Add image information to the database table
function storeImages($imgPath, $invId, $imgName) {
    $db = steeptConnect();
    $sql = 'INSERT INTO images (invid, imgpath, imgname) VALUES (:invid, :imgpath, :imgname)';
    $stmt = $db->prepare($sql);
    // Store the full size image information
    $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':imgpath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgname', $imgName, PDO::PARAM_STR);
    $stmt->execute();
        
    // Make and store the thumbnail image information
    // Change name in path
    $imgPath = makeThumbnailName($imgPath);
    // Change name in file name
    $imgName = makeThumbnailName($imgName);
    $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':imgpath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgname', $imgName, PDO::PARAM_STR);
    $stmt->execute();
    
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
   }

   // Get Image Information from images table
function getImages() {
    $db = steeptConnect();
    $sql = 'SELECT imgid, imgpath, imgname, imgdate, inventory.invid, invname FROM images JOIN inventory ON images.invid = inventory.invid';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $imageArray;
   }

   // Delete image information from the images table
function deleteImage($id) {
    $db = steeptConnect();
    $sql = 'DELETE FROM images WHERE imgid = :imgid';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':imgid', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();
    return $result;
   }

   // Check for an existing image
function checkExistingImage($imgName){
    $db = steeptConnect();
    $sql = "SELECT imgname FROM images WHERE imgname = :name";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
    $stmt->execute();
    $imageMatch = $stmt->fetch();
    $stmt->closeCursor();
    return $imageMatch;
   }

// Get information of -tn images using invid
function getTnInfo($invId){
    $db = steeptConnect();
    $sql = "SELECT imgpath, imgname FROM images WHERE imgpath LIKE '%-tn%' AND invid = :invid";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}