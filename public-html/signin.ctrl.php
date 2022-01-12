<?php
	session_start();
	require('system.ctrl.php');
    
	$user_id = $_POST["formSignInId"];
	$user_password = $_POST["formSignInPassword"];
    $user_option = $_POST["option"];
    //data is always a pair of name and value , so they are put in an associative array
    // we put the value of the user's id in an array to execute sql query
    
    $dbUserRow = phpCheck($user_option,$user_id);

    

    if (!is_array($dbUserRow)) { //if array doesn't exist then user not found in database
        $_SESSION["msgid"] = "808";
        header('Location: index.php');

    } else if ($user_password!=$dbUserRow[$_SESSION["user_password"]]) { //if password is wrong
        $_SESSION["msgid"] = "808";
        header('Location: index.php');

    } else if ($user_password==$dbUserRow[$_SESSION["user_password"]]) { //user OK, password OK
        if($user_option==1){
        $_SESSION["uid"] = $dbUserRow["professor_id"];
        header('Location: professor.php');
        }
        if($user_option==2){
            $_SESSION["uid"] = $dbUserRow["student_id"];
            header('Location: student.php');
        }
        if($user_option==3){
            $_SESSION["uid"] = $dbUserRow["it_users_id"];
            header('Location: it.php');
        }
        
    } else { 
        
        $_SESSION["msgid"] = "808"; echo "inside else";
        header('Location: index.php');
    }

?>