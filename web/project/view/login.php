<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="../css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/header.php'; ?>

</header>

<main class="formPage">

    <section>

    <h3>Please enter your user information to login</h3>

    <?php
    if (isset($message)) {
    echo $message;
    }
    ?>

    <form action="/project/accounts/index.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="clientEmail">Email</label>
            <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
        </div>
        <div>
            <span>Password must conatain at least 8 characters with at least 1 uppercase character, 1 number and 1 special character.</span>
            <label for="clientPassword">Password</label>
            <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
        </div>
        <input type="submit" class="button" value="Login">
        <input type="hidden" name="action" value="login">      
    </form>
        
    <p>- or -</p>

    <a href="../accounts/index.php?action=Registration" title="Not a user?  Make an account!">Create an Account</a>

    </section>

</main>

<footer>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>