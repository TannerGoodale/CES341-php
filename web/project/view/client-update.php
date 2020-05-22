<?php
if(!$_SESSION['loggedin']){
    header("Location: ../index.php");
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
if (isset($_SESSION['pErrorMessage'])) {
    $pErrorMessage = $_SESSION['pErrorMessage'];
}
$seshFirstName = $_SESSION['clientData']['clientFirstname'];
$seshLastName = $_SESSION['clientData']['clientLastname'];
$seshEmail = $_SESSION['clientData']['clientEmail'];
$seshClientId = $_SESSION['clientData']['clientId'];
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Client Data Update</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="http://cryptic-sands-03658.herokuapp.com/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/modules/header.php'; ?>

</header>

<main>

    <h1>Update user information</h1>

    <h3>Use this form to change your user info</h3>

    <?php
    if (isset($message)) {
    echo $message;
    }
    ?>

    <form action="http://cryptic-sands-03658.herokuapp.com/project/accounts/index.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="clientFirstName">First Name</label>
            <input type="text" name="clientFirstName" id="clientFirstName" <?php if(isset($_SESSION['clientData']['clientFirstname'])) {
            echo "value='$seshFirstName'"; }
            elseif(isset($clientFirstName)){echo "value='$clientFirstName'";} ?> required >
        </div>        
        <div>
            <label for="clientLastName">Last Name</label>
            <input type="text" name="clientLastName" id="clientLastName" <?php if(isset($_SESSION['clientData']['clientLastname'])) {
            echo "value='$seshLastName'"; }
            elseif(isset($clientLastName)){echo "value='$clientLastName'";} ?> required >
        </div>   
        <div>
            <label for="clientEmail">Email</label>
            <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($_SESSION['clientData']['clientEmail'])) {
            echo "value='$seshEmail'"; }
            elseif(isset($clientEmail)){echo "value='$clientEmail'";} ?> required >
        </div>
        <input type="submit" name="submitUpdate" id="userUpBtn" class="button" value="Update User Info">
        <input type="hidden" name="action" value="updateUserInfo">
        <input type="hidden" name="clientId" <?php echo "value='$seshClientId'"?>>
    </form>

    <h3>Use this form to chnage your password</h3>

    <?php
    if (isset($pErrorMessage)) {
    echo $pErrorMessage;
    }
    ?>

    <form action="http://cryptic-sands-03658.herokuapp.com/project/accounts/index.php" method="POST" enctype="multipart/form-data">
        <div>
            <span>Password must conatain at least 8 characters with at least 1 uppercase character, 1 number and 1 special character.</span>
            <span class="red">Changes to passwords are permanint!  Be carful when changing the password.</span>
            <label for="clientPassword">Password</label>
            <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
        </div>
        <input type="submit" name="submitUpdatePass" id="passUpBtn" class="button" value="Update Password">
        <input type="hidden" name="action" value="updatePassword">
        <input type="hidden" name="clientId" <?php echo "value='$seshClientId'"?>>
    </form>

</main>

<footer>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>