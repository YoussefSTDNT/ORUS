<?php
session_start();
require 'system.ctrl.php';

$studentId=$_POST["studentCriteriaId"];
$courseId=$_POST["studentCriteriaCourseId"];
$studentCourseMark=$_POST["studentCriteriaMark"];

//fetch the student and course primary key in student_courses table 
$db_data=array($studentId,$courseId);
$dbStudentCourseRow=phpFetchDB("SELECT * FROM student_courses WHERE student_id=? AND course_id=?;",$db_data);
$db_data="";

if (!is_array($dbStudentCourseRow)) { //if array doesn't exist then user not found in database
    $_SESSION["msgid"] = "860";
    header('Location: professor.php');
} else {
    //change the grade of the student with the related course using the row's primary key
    $db_data=array($studentCourseMark,$dbStudentCourseRow["student_course_id"]);
    phpModifyDB("UPDATE student_courses SET student_course_grade=? WHERE student_course_id=?;",$db_data);
    $db_data="";
    $_SESSION["msgid"] = "901";
    header("Location: professor.php");
}

?>