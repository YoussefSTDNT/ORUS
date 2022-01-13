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
    <title>Professor Page</title>
  </head>
  <body>

    <?php
    $db_data=array($_SESSION["uid"]);
    $dbUserRow=phpFetchDB('SELECT * FROM professors WHERE professor_id=?',$db_data);
    $db_data="";
    ?>

    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom sign-in-row rounded border border-dark">
            <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none col-lg-6">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Hi, <?php echo $dbUserRow["professor_name"];?></span>
            </div>
            <div class="ms-5 me-4">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="logout.ctrl.php" class="nav-link active" aria-current="page">Log Out</a></li>
                </ul>
            </div>
        </header>

        <div class="sign-in-row rounded border border-dark d-flex flex-column" >
            <!-- THIS FORM FOR SHOWING SELECTED STUDENTS -->
            <form action="showselectedstudents.ctrl.php" method="post">
                <div class="mb-3">
                    <select class="form-select" name="selectOption" aria-label="Default select example">
                        <option selected>Search Student based on</option>
                        <option value="1">ID</option>
                        <option value="2">Name</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
                    </div>
                    <input type="text" name="studentCriteriaText" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <?php if($_SESSION["showSelectedStudentsFlag"]==1){ ?>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">City</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Tuition</th>
                        <th scope="col">Dep. ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $db_data=array($_SESSION["studentCriteriaId"]);
                            $dbUserRow=phpFetchDB('SELECT * FROM students WHERE student_id=?',$db_data);
                            $db_data="";
                                echo '<tr>';
                                echo '<td>' . $dbUserRow['student_id'] . '</td>';
                                echo '<td>' . $dbUserRow['student_name'] . '</td>';
                                echo '<td>' . $dbUserRow['student_city'] . '</td>';
                                echo '<td>' . $dbUserRow['student_phone'] . '</td>';
                                echo '<td>' . $dbUserRow['student_tuition'] . '</td>';
                                echo '<td>' . $dbUserRow['department_id'] . '</td>';
                        ?>
                    </tbody>
                    </table>
            <?php } else if($_SESSION["showSelectedStudentsFlag"]==2) { ?>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">City</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Tuition</th>
                        <th scope="col">Dep. ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $db_data=array($_SESSION["studentCriteriaName"]);
                            $dbUserRow=phpFetchDB('SELECT * FROM students WHERE student_name=?',$db_data);
                            $db_data="";
                                echo '<tr>';
                                echo '<td>' . $dbUserRow['student_id'] . '</td>';
                                echo '<td>' . $dbUserRow['student_name'] . '</td>';
                                echo '<td>' . $dbUserRow['student_city'] . '</td>';
                                echo '<td>' . $dbUserRow['student_phone'] . '</td>';
                                echo '<td>' . $dbUserRow['student_tuition'] . '</td>';
                                echo '<td>' . $dbUserRow['department_id'] . '</td>';
                        ?>
                    </tbody>
                </table>
            <?php  } ?>

        </div>
        <div class="sign-in-row rounded border border-dark d-flex flex-column" >
            <!-- THIS FORM FOR SHOWING ALL STUDENTS -->
            <form name="formShowStudents" action="showstudents.ctrl.php" method="post">
                <button type="submit" class="btn btn-primary" id="formShowStudentsButton" onclick="jsHideButtonOfShowAll();">Show all Students Data</button>
            </form>

            <?php if(!empty($_SESSION["showStudentsFlag"])){ ?>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">City</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Tuition</th>
                        <th scope="col">Dep. ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($connection->query('select * from students') as $record){ ?>
                            <?php
                            echo '<tr>';
                            echo '<td>' . $record['student_id'] . '</td>';
                            echo '<td>' . $record['student_name'] . '</td>';
                            echo '<td>' . $record['student_city'] . '</td>';
                            echo '<td>' . $record['student_phone'] . '</td>';
                            echo '<td>' . $record['student_tuition'] . '</td>';
                            echo '<td>' . $record['department_id'] . '</td>';
                            echo '</tr>';
                            ?>
                        <?php } ?>
                    </tbody>
                    </table>
            <?php } ?>

            <?php if($_SESSION["showStudentsFlag"]==1) {?>
                <form name="formHideStudents" action="hidestudents.ctrl.php" method="post">
                    <div class="">
                <button type="submit" class="btn btn-primary" id="formHideStudentsButton" onclick="jsShowButtonOfShowAll();">Hide all Students Data</button>
                    </div>
                </form>
            <?php } ?>
        </div>
        <div class="sign-in-row rounded border border-dark d-flex flex-column" >
                
        </div>

    </div>

    <?php 
        $_SESSION["showSelectedStudentsFlag"]=""; 
        $_SESSION["showStudentsFlag"]="";
        $_SESSION["studentCriteriaName"]="";
        $_SESSION["studentCriteriaId"]="";
    ?>

    <!-- Optional JavaScript; choose one of the two! -->
    <script>
        
        function jsHideButtonOfShowAll() {
            document.getElementById("formShowStudentsButton").classList.add("d-none");
        }
        function jsShowButtonOfShowAll() {
            document.getElementById("formShowStudentsButton").classList.remove("d-none");
            document.getElementById("formHideStudentsButton").classList.add("d-none");
        }
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>