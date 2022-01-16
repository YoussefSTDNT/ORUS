<?php
session_start();
require 'system.ctrl.php';

$studentId=$_POST["studentCriteriaId"];
$courseId=$_POST["studentCriteriaCourseId"];
$studentCourseAttendance=$_POST["studentCriteriaAttendance"];

//fetch the student and course primary key in student_courses table 
$db_data=array($studentId,$courseId);
$dbStudentCourseRow=phpFetchDB("SELECT * FROM student_courses WHERE student_id=? AND course_id=?;",$db_data);
$db_data="";

//change the grade of the student with the related course using the row's primary key
$db_data=array($studentCourseAttendance,$dbStudentCourseRow["student_course_id"]);
phpModifyDB("UPDATE student_courses SET student_course_attendance=? WHERE student_course_id=?;",$db_data);
$db_data="";
header("Location: professor.php");
?>