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
    <title>Student Page</title>
  </head>
  <body>

    <?php
    $db_data=array($_SESSION["uid"]);
    $dbUserRow=phpFetchDB('SELECT * FROM students WHERE student_id=?',$db_data);
    $db_data="";
    ?>
    
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom sign-in-row border border-dark">
            <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none col-lg-6">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Hi, Student <?php echo $dbUserRow["student_name"];?></span>
            </div>
            <div class="ms-5 me-4">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="logout.ctrl.php" class="nav-link active" aria-current="page">Log Out</a></li>
                </ul>
            </div>
        </header>

        <!-- SYSTEM FEEDBACK MESSAGES -->
        <?php if (!empty($_SESSION["msgid"]) && phpShowSystemFeedback($_SESSION["msgid"])[0]!="") { ?>

            <div class="row d-flex justify-content-center">
                <div class="col-10 text-center">
                    <div class="alert alert-<?php echo (phpShowSystemFeedback($_SESSION['msgid'])[0]); ?>" role="alert">
                    <h2><?php echo (phpShowSystemFeedback($_SESSION['msgid'])[1]); ?></h2>
                    </div>
                </div>
            </div>

        <?php } ?>

        <div class="container">

            <!-- STUDENT REGISTRATION FORM -->
            <div class="rounded-top border border-dark mb-0 sign-in-row col-3">
                <h2>Registration</h2>
            </div>
            <form name="formStudentRegistration" action="student-registration.ctrl.php" method="post">
                <div class="sign-in-row rounded border border-dark flex-column">
                    <table class="table table-responsive text-center">
                        <thead>
                        
                            <tr>
                            <th scope="col">Check</th>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Seats Available</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($connection->query('select * from courses') as $record){ ?>
                                <?php
                                echo '<tr>';
                                echo "<td><input class='form-check-input' type='checkbox' name='". $record['course_id'] . "' value='". $record['course_id'] . "' id='flexCheckDefault'></td>"; 
                                echo '<td>' . $record['course_id'] . '</td>';
                                echo '<td>' . $record['course_name'] . '</td>';
                                echo '<td>' . $record['course_seats'] . '</td>';
                                echo '</tr>';
                                ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="mb-2">
                    <button type='submit button' class='btn btn-primary'>Submit</button>
                    </div>
                </div>
            </form>

            <!-- Student's Registered Courses, his marks and attendace -->
            <div class="rounded-top border border-dark mb-0 sign-in-row col-3">
                <h3>Courses Registered</h3>
            </div>
            <div class="sign-in-row rounded border border-dark flex-column">
                <table class="table table-responsive text-center">
                    <thead>
                    
                        <tr>
                        <th scope="col">Course ID</th>
                        <th scope="col">Your Grade</th>
                        <th scope="col">Your Attendance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- How to use a variable inside query.
                                since the query is already a string you can just concatenate using (.) dot
                                and depending if you want it a number or not you put ' before " and then ' after " if it's a string(characters) and not a number -->
                        <?php foreach($connection->query("SELECT student_id,course_id,student_course_grade,student_course_attendance FROM student_courses WHERE student_id=". $_SESSION['uid'] .";") as $record){ ?>
                            <?php
                            echo '<tr>';
                            echo '<td>' . $record['course_id'] . '</td>';
                            echo '<td>' . $record['student_course_grade'] . '</td>';
                            echo '<td>' . $record['student_course_attendance'] . '</td>';
                            echo '</tr>';
                            ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php $_SESSION["msgid"]="";?>
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