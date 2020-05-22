<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Registration Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="../css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/header.php'; ?>

</header>

<main class="formPage">

<h3>Please enter your account information</h3>

<?php
if (isset($message)) {
 echo $message;
}
?>

<form action="../accounts/index.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="clientFirstName">First Name</label>
            <input type="text" name="clientFirstName" id="clientFirstName" <?php if(isset($clientFirstName)){echo "value='$clientFirstName'";}  ?> required>
        </div>        
        <div>
            <label for="clientLastName">Last Name</label>
            <input type="text" name="clientLastName" id="clientLastName" <?php if(isset($clientLastName)){echo "value='$clientLastName'";} ?> required>
        </div>   
        <div>
            <label for="clientEmail">Email</label>
            <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
        </div> 
        <div>
            <span>Password must conatain at least 8 characters with at least 1 uppercase character, 1 number and 1 special character.</span>
            <label for="clientPassword">Password</label>
            <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
        </div>
        <input type="submit" name="submit" id="regbtn" class="button" value="Register">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="register">   
    </form>

</main>

<footer>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>