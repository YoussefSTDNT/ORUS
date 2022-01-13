<?php
    session_start();

    $_SESSION["showStudentsFlag"]=0;
    header("Location: professor.php");
?>