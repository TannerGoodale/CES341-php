<?php
//Main Controller
  
// Create or access a Session 
session_start();

// Create controll structure for dynamic site navigation
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}
switch ($action) {
  case 'home':
    include 'views/home.php';
  break;

  case 'about':
    include 'views/aboutme.php';
  break;

  default:
    include 'views/home.php';
}
?>