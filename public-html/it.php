<?php 
session_start();
require 'system.ctrl.php';
if(empty($_SESSION["uid"])){
    header('Location: index.php');
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ORUSystem CSS -->
    <link rel="stylesheet" href="orus.css">
    <title>IT Page</title>
  </head>
  <body>

    <?php
    $db_data=array($_SESSION["uid"]);
    $dbUserRow=phpFetchDB('SELECT * FROM it_users WHERE it_users_id=?',$db_data);
    $db_data="";
    ?>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom sign-in-row rounded border border-dark">
            <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none col-lg-6">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Hi, <?php echo $dbUserRow["it_users_name"];?></span>
            </div>
            <div class="ms-5 me-4">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="logout.ctrl.php" class="nav-link active" aria-current="page">Log Out</a></li>
                </ul>
            </div>
    </header>
    
    <div class="container">
        
        </div>

    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>