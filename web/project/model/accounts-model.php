<?php

/*Accounts model*/


/*Insert site visitor into database*/

function regClient($clientFirstName, $clientLastName, $clientEmail, $clientPassword)
{
                //Connect to acme database
                $db   = steeptConnect();
                // The SQL statement
                $sql  = 'INSERT INTO clients (clientfirstname, clientlastname, clientemail, clientpassword)
    VALUES (:clientfirstname, :clientlastname, :clientemail, :clientpassword)';
                // Create the prepared statement using the acme connection
                $stmt = $db->prepare($sql);
                // The next four lines replace the placeholders in the SQL
                // statement with the actual values in the variables
                // and tells the database the type of data it is
                $stmt->bindValue(':clientfirstname', $clientFirstName, PDO::PARAM_STR);
                $stmt->bindValue(':clientlastname', $clientLastName, PDO::PARAM_STR);
                $stmt->bindValue(':clientemail', $clientEmail, PDO::PARAM_STR);
                $stmt->bindValue(':clientpassword', $clientPassword, PDO::PARAM_STR);
                // Insert the data
                $stmt->execute();
                // Ask how many rows changed as a result of our insert
                $rowsChanged = $stmt->rowCount();
                // Close the database interaction
                $stmt->closeCursor();
                // Return the indication of success (rows changed)
                return $rowsChanged;
}

// Check for an existing email address
function checkExistingEmail($clientEmail)
{
                // Connect to database
                $db   = steeptConnect();
                // Prepare the SQL statment
                $sql  = 'SELECT clientemail FROM clients WHERE clientemail = :email';
                $stmt = $db->prepare('SELECT clientemail FROM clients WHERE clientemail = :email');
                // Connect ':email" to the parameter "$clientEmail"
                $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
                // Execute the statment
                $stmt->execute();
                // Put results into a variable
                $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
                // End database manipulation for the function
                $stmt->closeCursor();
                // Check if the function returnes empty or if the email already exsitis
                if (empty($matchEmail)) {
                                return 0;
                } else {
                                return 1;
                }
}


// Get client data based on an email address
function getClient($clientEmail)
{
                // Connect to the database
                $db   = steeptConnect();
                // Prepare the SQL statment
                $sql  = 'SELECT clientid, clientfirstname, clientlastname, clientemail, 
            clientlevel, clientpassword FROM clients WHERE clientemail = :email';
                $stmt = $db->prepare($sql);
                // Bind ':email' to the parameter "$clientEmail"
                $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
                // Execute the statment
                $stmt->execute();
                // Put the results into a variable
                $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
                // End database connection for the function
                $stmt->closeCursor();
                // Return the data in the variable
                return $clientData;
}

// Get client data based on the clietnId
function getClientById($clientId)
{
                // Connect to the database
                $db   = steeptConnect();
                // Prepare the SQL statment
                $sql  = 'SELECT clientid, clientfirstname, clientlastname, clientemail, 
    clientlevel, clientpassword FROM clients WHERE clientid = :clientid';
                $stmt = $db->prepare($sql);
                // Bind ':email' to the parameter "$clientEmail"
                $stmt->bindValue(':clientid', $clientId, PDO::PARAM_STR);
                // Execute the statment
                $stmt->execute();
                // Put the results into a variable
                $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
                // End database connection for the function
                $stmt->closeCursor();
                // Return the data in the variable
                return $clientData;
}

// Update client data based on the clietnId
function updateUserInfo($clientFirstName, $clientLastName, $clientEmail, $clientId)
{
                // Connect to the database
                $db   = steeptConnect();
                // Prepare the SQL statment
                $sql  = 'UPDATE clients SET clientfirstname = :clientfirstname, clientlastname = :clientlastname, clientemail = :clientemail
    WHERE clientid = :clientid';
                $stmt = $db->prepare($sql);
                // Bind ':email' to the parameter "$clientEmail"
                $stmt->bindValue(':clientfirstname', $clientFirstName, PDO::PARAM_STR);
                $stmt->bindValue(':clientlastname', $clientLastName, PDO::PARAM_STR);
                $stmt->bindValue(':clientemail', $clientEmail, PDO::PARAM_STR);
                $stmt->bindValue(':clientid', $clientId, PDO::PARAM_STR);
                // Execute the statment
                $stmt->execute();
                // Put the results into a variable
                $rowsChanged = $stmt->rowCount();
                // Close the database interaction
                $stmt->closeCursor();
                // Return the indication of success (rows changed)
                return $rowsChanged;
}

// Update client password based on the clietnId
function passwordUpdate($hashUpdatedPassword, $clientId)
{
                // Connect to the database
                $db   = steeptConnect();
                // Prepare the SQL statment
                $sql  = 'UPDATE clients SET clientpassword = :clientpassword
    WHERE clientid = :clientid';
                $stmt = $db->prepare($sql);
                // Bind ':email' to the parameter "$clientEmail"
                $stmt->bindValue(':clientpassword', $hashUpdatedPassword, PDO::PARAM_STR);
                $stmt->bindValue(':clientid', $clientId, PDO::PARAM_STR);
                // Execute the statment
                $stmt->execute();
                // Put the results into a variable
                $rowsChanged = $stmt->rowCount();
                // Close the database interaction
                $stmt->closeCursor();
                // Return the indication of success (rows changed)
                return $rowsChanged;
}