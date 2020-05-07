<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</head>
<body class="container-fluid">
        <h6 class="invisible">1</h6>
        <main class="container-md">    
        <h1 class="display-4 text-center">Form Handling Demo</h1>
        <h6 class="invisible">1</h6>
        <div class="container-md">
            <p class="h4 text-center">Welcome <span class="h4 text-muted"> <?php echo $name; ?> </span></p>
            <p class="h4 text-center">Your email address is <span class="h4 text-muted"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></span></a></p>
            <p class="h4 text-center">Your major is: <span class="h4 text-muted"> <?php echo $major; ?></span></p>
            <p class="h4 text-center">You have been in the following places: <span class="h4 text-muted"> <?php if(isset($placesCoded)){echo $placesCoded;}?></span></p>
            <blockquote class="blockquote text-center">
                <p class="mb-0 display-4">"<?php echo $comments;  ?>"</p>
                <footer class="blockquote-footer"><?php echo $name; ?></footer>
            </blockquote>
        </div>
        </main>
    </body>
</html>