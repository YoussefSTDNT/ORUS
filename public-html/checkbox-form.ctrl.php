<?php 
    session_start();
    require 'system.ctrl.php';

    //fetching seats from DB to check if available, to send feedback message either success or failure
    //and only if success then we register courses (change values in DB).
    $db_data=array(2001);
    $dbUserRow1=phpFetchDB("SELECT course_seats FROM courses WHERE course_id=?;",$db_data);
    $db_data="";
    $db_data=array(2002);
    $dbUserRow2=phpFetchDB("SELECT course_seats FROM courses WHERE course_id=?;",$db_data);
    $db_data="";
    $db_data=array(2003);
    $dbUserRow3=phpFetchDB("SELECT course_seats FROM courses WHERE course_id=?;",$db_data);
    $db_data="";
    if($dbUserRow1["course_seats"]<1){
        $_SESSION["msgid"]="801";
        //header("Location: student.php");
    } else if($dbUserRow2["course_seats"]<1) {
        $_SESSION["msgid"]="802";
        //header("Location: student.php");
    } else if($dbUserRow3["course_seats"]<1) {
        $_SESSION["msgid"]="803";
        //header("Location: student.php");
    }

    }
    if($_POST["2001"]==2001){
        
        $db_data=array($_SESSION["uid"],2001);
        phpModifyDB("INSERT INTO student_courses (student_id, course_id) VALUES (?, ?);",$db_data);
        $db_data="";

        //-1 of seats because succesful registration
        $dbUserRow1["course_seats"]--;
        $db_data=array($dbUserRow1["course_seats"]);
        phpModifyDB("INSERT INTO courses (course_seats) VALUES (?) WHERE course_id=2001;",$db_data);
        $db_data="";

    }
    if($_POST["2002"]==2002){
        $db_data=array($_SESSION["uid"],2002);
        phpModifyDB("INSERT INTO student_courses (student_id, course_id) VALUES (?, ?);",$db_data);
        $db_data="";

        //-1 of seats because succesful registration
        $dbUserRow1["course_seats"]--;
        $db_data=array($dbUserRow1["course_seats"]);
        phpModifyDB("INSERT INTO courses (course_seats) VALUES (?) WHERE course_id=2002;",$db_data);
        $db_data="";
    }
    if($_POST["2003"]==2003){
        $db_data=array($_SESSION["uid"],2003);
        phpModifyDB("INSERT INTO student_courses (student_id, course_id) VALUES (?, ?);",$db_data);
        $db_data="";

        //-1 of seats because succesful registration
        $dbUserRow1["course_seats"]--;
        $db_data=array($dbUserRow1["course_seats"]);
        phpModifyDB("INSERT INTO courses (course_seats) VALUES (?) WHERE course_id=2003;",$db_data);
        $db_data="";
    }
    $_SESSION["msgid"]="900";
    //header("Location: student.php");
?>