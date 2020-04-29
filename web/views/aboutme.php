<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tachyons/css/tachyons.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div id="container" class="measure-wide">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/modules/header.php';?>
        </header>
        <main>
            <section>
                <h1>About Me</h1>
                    <p>
                        Hello, my name is Tanner Goodale. I'm an avid outdoorsman, passionate gearhead,
                        aspiring web developer and most of all, a happy father and husband. You’re probably
                        most interested in the web developer part, so I’ll chronical my journey to becoming one below.
                        A heads up though, it's going to be the short version.
                    </p>
                    <p>
                        About a year and half ago, I worked in the wide world of thankless bule collar labor.
                        I was good at what I did, but as time went on, I grew tired of being another pawn.
                        I guess being exposed to fiber optic radiation isn't good for you either.  Anyway, I needed
                        a new career option and something that wasn't going to be as taxing to my health or sanity.
                        Thus, I reapplied to BYU-I and clicked the first major that I found remotely intresting.
                        That is how I started the road to becoming a web developer, and so far, I've enjoyed it.
                    </p>
            </section>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php';?>
        </footer>
    </div>
</body>
</html>