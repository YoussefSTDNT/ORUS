<?php

 require 'db-conn.inc.php';

 echo '<table border="1">';
 foreach($connection->query('select * from students') as $record){
     //print_r($record);
     echo '<tr>';
     echo '<td>' . $record['student_id'] . '</td>';
     echo '<td>' . $record['student_name'] . '</td>';
     echo '<td>' . $record['student_password'] . '</td>';
     echo '<td>' . $record['student_city'] . '</td>';
     echo '<td>' . $record['student_phone'] . '</td>';
     echo '<td>' . $record['student_tuition'] . '</td>';
     echo '<td>' . $record['department_id'] . '</td>';
     echo '</tr>';
 }
 echo '</table>';

?>