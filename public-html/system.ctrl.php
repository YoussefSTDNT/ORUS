<?php
require 'db-conn.inc.php';

// Place directly inside Bootstrap container to keep the right structure of Bootstrap document
function phpShowSystemFeedback($feedback_id) {
	switch ($feedback_id) {
        case "808":
            $feedback_type="danger";
            $feedback_text="Wrong email or password!";
            break;
        default:
            $feedback_type="";
            $feedback_text="";
    }

    return [$feedback_type, $feedback_text];
}

    // Create, update or delete a record in the database
    function phpModifyDB($db_query, $db_data) {
      global $connection;
        
      //https://www.php.net/manual/en/pdo.prepare.php
      //prepare returns an object if everything is fine and if successfully escaped the malicious data entry
      //returns false otherwise depending on error handling
      //prepare method takes the SQL query as argument
      $statement = $connection->prepare($db_query);
      //https://www.php.net/manual/en/pdostatement.execute.php
      //execute method takes the value as an array , $db_data is array
      //we use the object returned from the prepare method on the execute method
      $statement->execute($db_data);
    }

    //https://www.php.net/manual/en/pdo.query.php

    // Get the information from the database
    function phpFetchDB($db_query, $db_data) {
      global $connection;
  
      $statement = $connection->prepare($db_query); //returns an array of objects (query and prepare return the same object but prepare is better for security)
      $statement->execute($db_data);
  
      //setting the fetch mode and returning the result
      //we use FETCH_ASSOC so it returns the row as an associative array
      return $statement->fetch(PDO::FETCH_ASSOC);

      //how to normally fetch a row from the database
      //https://www.ibm.com/docs/en/db2/9.7?topic=rqrs-fetching-rows-columns-from-result-sets
    }

    function phpCheck($user_option,$user_id){
        if($user_option==1){
            $db_data = array($user_id);
            //fetching the row by id column, fetch returns the first (and only one because it's a unique ID) result entry
            $dbUserRow = phpFetchDB('SELECT * FROM professors WHERE professor_id = ?', $db_data);
            $db_data = "";
            $_SESSION["user_password"]="professor_password";
            return $dbUserRow;
        }
        else if($user_option==2){
            $db_data = array($user_id);
            //fetching the row by id column, fetch returns the first (and only one because it's a unique ID) result entry
            $dbUserRow = phpFetchDB('SELECT * FROM students WHERE student_id = ?', $db_data);
            $db_data = "";
            $_SESSION["user_password"]="student_password";
            return $dbUserRow;
        }
        else if($user_option==3){
            $db_data = array($user_id);
            //fetching the row by id column, fetch returns the first (and only one because it's a unique ID) result entry
            $dbUserRow = phpFetchDB('SELECT * FROM it_users WHERE it_users_id = ?', $db_data);
            $db_data = "";
            $_SESSION["user_password"]="it_user_password";
            return $dbUserRow;
        }
    }

?>