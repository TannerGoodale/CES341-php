<?php

//This is for the Acme Model.

function getCategories()
{
                
                //Connect to database.
                $db = steeptConnect();
                
                //Query info from database.
                $sql = 'SELECT * FROM categories ORDER BY categoryName ASC';
                
                //Create prepared statment using acmeConnect function and pre made SQL query.
                $stmt = $db->prepare($sql);
                
                //Run the prepare statment.
                $stmt->execute();
                
                // The next line gets the data from the database and 
                // stores it as an array in the $categories variable 
                $categories = $stmt->fetchAll();
                
                //Close interaction with database.
                $stmt->closeCursor();
                
                // The next line sends the array of data back to where the function 
                // was called (this should be the controller) 
                return $categories;
                
}