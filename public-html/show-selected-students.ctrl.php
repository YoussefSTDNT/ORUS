<?php
    session_start();

    $_SESSION["showSelectedStudentsFlag"]=$_POST["selectOption"];
    if($_SESSION["showSelectedStudentsFlag"]==1){
        $_SESSION["studentCriteriaId"]=$_POST["studentCriteriaText"];
    }
    else if($_SESSION["showSelectedStudentsFlag"]==2){
        $_SESSION["studentCriteriaName"]=$_POST["studentCriteriaText"];
    }
    header("Location: professor.php");
?>