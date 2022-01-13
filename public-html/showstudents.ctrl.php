<?php
    session_start();

    $_SESSION["showStudentsFlag"]=1;
    header("Location: professor.php");
?>