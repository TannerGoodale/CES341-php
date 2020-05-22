<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Acme Home Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="http://cryptic-sands-03658.herokuapp.com/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/modules/header.php'; ?>

</header>

<main>

    <section>
        <h1>Welcome to SteeptClub</h1>
        
        <div class="hero">
            <img src="http://cryptic-sands-03658.herokuapp.com/project/images/site/rocketfeature.jpg" alt="Classic acme rocket">
            <div class="center-right">
                <ul>
                    <li><h2>Acme Rocket</h2></li>
                    <li>Quick lighting fuse</li>
                    <li>NHTSA approved seat belts</li>
                    <li>Mobile launch stand included</li>
                    <li><a href="/acme/cart/"><img id="actionbtn" alt="Add to cart button" src="http://cryptic-sands-03658.herokuapp.com/project/images/site/iwantit.gif"></a></li>
                </ul>
            </div>
        </div>
        
        <div class="hero-reviews">
            <h3>Acme Rocket Reviews</h3>
            <ul>
                <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                <li>"That thing was fast!" (4/5)</li>
                <li>"Talk about fast delivery." (5/5)</li>
                <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
            </ul>
        </div>
            
    </section>
    
    <section id="fr">
        
        <h3>Featured Recipes</h3>
        
        <div id="recipes">

            <div class="grid-item"><a href="/"><div class="backgrounded"><img src="http://cryptic-sands-03658.herokuapp.com/project/images/recipes/bbqsand.jpg" alt="Roadrunner BBQ sandwich recipe"></div></a><span><a href="/">Pulled Roadrunner BBQ</a></span></div>
            <div class="grid-item"><a href="/"><div class="backgrounded"><img src="http://cryptic-sands-03658.herokuapp.com/project/images/recipes/potpie.jpg" alt="Roadrunner potpie recipe"></div></a><span><a href="/">Roadrunner Pot Pie</a></span></div>
            <div class="grid-item"><a href="/"><div class="backgrounded"><img src="http://cryptic-sands-03658.herokuapp.com/project/images/recipes/soup.jpg" alt="Roadrunner soup recipe"></div></a><span><a href="/">Roadrunner Soup</a></span></div>
            <div class="grid-item"><a href="/"><div class="backgrounded"><img src="http://cryptic-sands-03658.herokuapp.com/project/images/recipes/taco.jpg" alt="Roadrunner taco recipe"></div></a><span><a href="/">Roadrunner Tacos</a></span></div>

        </div>
    
    </section>


</main>

<footer>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/acme/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>