<?php

// Controller for teamactivity03 form page

// Create or access a Session 
session_start();

// Create controll structure for dynamic site navigation
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}
switch ($action) {
  case 'submit':

    //Person's name
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

    //Person's email
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

    //Person's major
    $major = filter_input(INPUT_POST, 'major', FILTER_SANITIZE_STRING);

    //Person's comments
    $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);

    //Output places message;
    $placesMessage = "";

    $visits = array();
    for ($i = 0; $i < 7; $i++) {
        if (isset($_POST["visit" . $i])) {
            switch ($_POST["visit" . $i]) {
                case ("na"):
                    array_push($visits, "North America");
                    break;
                case ("sa"):
                    array_push($visits, "South America");
                    break;
                case ("eu"):
                    array_push($visits, "Europe");
                    break;
                case ("as"):
                    array_push($visits, "Asia");
                    break;
                case ("au"):
                    array_push($visits, "Australia");
                    break;
                case ("af"):
                    array_push($visits, "Africa");
                    break;
                case ("an"):
                    array_push($visits, "Antarctica");
                    break;
                default:
                    break;
            }
        }
    }

    if(empty($name) || empty($email || empty($major) || empty($comments) || empty($visits))){
        $errMessage = '<p>Please enter data for all form fields</p>';
        $majors = array(
            "cs"=>"Computer Science",
            "wdd"=>"Web Design and Development",
            "cit"=>"Computer information Technology",
            "ce"=>"Computer Engineering"
            );
        include 'teamactivity03.php';
        exit;
    }

    include 'teamactivity03-display.php';
  break;

  default:

    $majors = array(
    "cs"=>"Computer Science",
    "wdd"=>"Web Design and Development",
    "cit"=>"Computer information Technology",
    "ce"=>"Computer Engineering"
    );

    include 'teamactivity03.php';
}

?>