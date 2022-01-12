<?php

require 'db-pswd.inc.php';

try {

    //DOCKER
    //$connection = new PDO('mysql:host=mysql;dbname=talker_db', 'root', 'talker-root-password');

    //VAGRANT //PDO is a php extension (class added to the php code to access and modify data in a database) to connect php and mysql database
    $connection = new PDO('mysql:host=localhost;dbname=orus_db', VAGRANT[0], VAGRANT[1]);

    //XAMPP
    //$connection = new PDO('mysql:host=localhost;dbname=talker_db', 'root', '');

    //print "Success! Connected to the database!";

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>