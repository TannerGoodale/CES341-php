<?php
if(!$_SESSION['loggedin']){
    header("Location: http://cryptic-sands-03658.herokuapp.com/project/index.php");
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
if (isset($_SESSION['reviewMessage'])){
    $reviewMessage = $_SESSION['reviewMessage'];
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Admin View</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="http://cryptic-sands-03658.herokuapp.com/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/modules/header.php'; ?>

</header>

<main>

    <h1><?php echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname']?></h1>

    <?php
    if (isset($message)) {
    echo $message;
    }
    if (isset($reviewMessage)) {
    echo $reviewMessage;
    }
    ?>

    <p>You are logged in</p>

    <ul>
        <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname'];?></li>
        <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'];?></li>
        <li>Client Email: <?php echo $_SESSION['clientData']['clientEmail'];?></li>
    </ul>

    <a href="http://cryptic-sands-03658.herokuapp.com/project/accounts/index.php?action=updateUser" id="userUpdateLink">Update Account Information</a>

    <?php
    if($_SESSION['clientData']['clientLevel'] > 1){
        echo '<p>Administrative Functions<p>';
        echo $advancedMessage;
    }
    ?>

    <hr>

    <h3>Your Reviews</h3>

    <?php if(isset($results)){echo $results;}else{echo "<p>You've made no reviews yet</p>";}?>

</main>

<footer>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>
<?php 
if (isset($_SESSION['message'])){unset($_SESSION['message']);}
if (isset($_SESSION['reviewMessage'])){unset($_SESSION['reviewMessage']);}
?>