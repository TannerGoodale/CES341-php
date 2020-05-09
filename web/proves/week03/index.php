<?php
// Controller for shopping cart activity week 03
// Template shopping cart / no credit card active
// Body of program pre built in main controller

require_once '../week03/library/fakedb.php';

// Create or access a Session 
session_start();

// Generate session points
$cartContent = array();

// Create controll structure for dynamic site navigation
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}
switch ($action) {

  default:

  $tnDisplay = buildProductTNDisplay($products);

  include 'views/browse.php';
}
?>