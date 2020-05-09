<?php
// Controller for shopping cart activity week 03
// Template shopping cart / no credit card active

require_once '../week03/library/fakedb.php';

// Create or access a Session 
session_start();

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