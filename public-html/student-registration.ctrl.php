<?php 
    session_start();
    require 'system.ctrl.php';

    //server side checkbox validation (at least one box has to be checked/selected)
    if(empty($_SESSION["msgid"]) && empty($_POST["2001"]) && empty($_POST["2002"]) && empty($_POST["2003"])){
        $_SESSION["msgid"]="850";
        header("Location: student.php");
    }

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
    
    //we need to check first from what the student selected if courses are available or not through seats
    if($_POST["2001"]=='2001'){
        if($dbUserRow1["course_seats"]<1){
            $_SESSION["msgid"]="801";
            header("Location: student.php");
        }
    }
    if($_POST["2002"]=='2002'){
        if($dbUserRow2["course_seats"]<1) {
            $_SESSION["msgid"]="802";
            header("Location: student.php");
        }
    }
    if($_POST["2003"]=='2003'){
        if($dbUserRow3["course_seats"]<1) {
            $_SESSION["msgid"]="803";
            header("Location: student.php");
        }
    }

    //if seats are available in all selected courses then register and change seats
    // we have to add another condition because this is always checked with the above conditions. meaning they are on the same level. by adding another condition they are not on the same level of conditions so there's an order of checking so the program will behave as intendedl. The intention is to only insert and update data ONLY after the seats of all courses are checked 
    if($_POST["2001"]=='2001' && empty($_SESSION["msgid"])){
        $db_data=array($_SESSION["uid"],'2001');
        phpModifyDB("INSERT INTO student_courses (student_id, course_id) VALUES (?, ?);",$db_data);
        $db_data="";

        //-1 of seats because successful registration
        $dbUserRow1["course_seats"]--;
        $db_data=array($dbUserRow1["course_seats"]);
        phpModifyDB("UPDATE courses SET course_seats=? WHERE course_id=2001;",$db_data);
        $db_data="";
    }
    if($_POST["2002"]=='2002' && empty($_SESSION["msgid"])){
        $db_data=array($_SESSION["uid"],'2002');
        phpModifyDB("INSERT INTO student_courses (student_id, course_id) VALUES (?, ?);",$db_data);
        $db_data="";

        //-1 of seats because successful registration
        $dbUserRow2["course_seats"]--;
        $db_data=array($dbUserRow2["course_seats"]);
        phpModifyDB("UPDATE courses SET course_seats=? WHERE course_id=2002;",$db_data);
        $db_data="";
    }
    if($_POST["2003"]=='2003' && empty($_SESSION["msgid"])){
        $db_data=array($_SESSION["uid"],'2003');
        phpModifyDB("INSERT INTO student_courses (student_id, course_id) VALUES (?, ?);",$db_data);
        $db_data="";

        //-1 of seats because successful registration
        $dbUserRow3["course_seats"]--;
        $db_data=array($dbUserRow3["course_seats"]);
        phpModifyDB("UPDATE courses SET course_seats=? WHERE course_id=2003;",$db_data);
        $db_data="";
    }
    if(empty($_SESSION["msgid"])){
        $_SESSION["msgid"]="900";
        header("Location: student.php");
    }
    
?>