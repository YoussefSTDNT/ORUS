<?php
    session_start();

    $_SESSION["studentCriteriaId"]=$_POST["studentCriteriaId"];
    header("Location: it.php");
?>