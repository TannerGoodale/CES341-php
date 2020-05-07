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
<body>
    <div id="container">
        <header>

        </header>
        <main>
            <section>
            <h1 class="display-4 text-center">Form Handling Demo</h1>
                <h6 class="invisible">1</h6>

                <?php if(isset($errMessage)){echo $errMessage;} ?>

                <!-- Form STARTS -->

                <form class="container-fluid" action="teamactivity03-controller.php" method="post">

                <!-- Name section STARTS -->
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
                            <small id="namelHelp" class="form-text text-muted">e.g. Jhon Smith</small>
                        </div>
                    </div>
                    <!-- Name section ENDS -->

                    <!-- Email section STARTS -->
                    <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email address</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    </div>
                    <!-- Name section ENDS -->

                <!-- Choose your major radio buttons STARTS --> 
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Major</label>
                        <?php
                        foreach ($majors as $key=>$major) {
                            print '<input type="radio" name="major" value="' . $key . '"> ' . $major . '<br>';
                        }
                        ?>
                    </div>

                <!-- Choose your major radio buttons ENDS --> 

                <!-- Comments section STARTS -->
                <div class="form-group row">
                    <label for="comments" class="col-sm-2 col-form-label">Comments</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                    <small id="commentslHelp" class="form-text text-muted">Tell us something special about you</small>
                    </div>
                </div>
                <!-- Comments section ENDS -->

                <!-- Continents section STARTS -->
                <div class="form-group row">
                    <label for="comments" class="col-sm-2 col-form-label">Continents you have visited</label>
                    <div class="col-sm-10">
                    <input type="checkbox" name="visit0" value="na"> North America
                    <input type="checkbox" name="visit1" value="sa"> South America
                    <input type="checkbox" name="visit2" value="eu"> Europe
                    <input type="checkbox" name="visit3" value="as"> Asia
                    <input type="checkbox" name="visit4" value="au"> Australia
                    <input type="checkbox" name="visit5" value="af"> Africa
                    <input type="checkbox" name="visit6" value="an"> Antarctica
                    <small id="placeslHelp" class="form-text text-muted">Check all the places you have been</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                    <input type="hidden" name="action" value="submit">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

                <!-- Comments section ENDS -->

                </form>

          <!-- Form ENDS -->
            </section>
        </main>
        <footer>

        </footer>
    </div>
</body>
</html>