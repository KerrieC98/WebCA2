<?php

require_once("database.php");



$student_id = filter_input(INPUT_POST, "student_id");
$module_id = filter_input(INPUT_POST, "module_id");

if (!isset($student_id)) {
    $error = "Please select a student to remove from a module.";
    include("index.php");
    exit();
}

$queryStudents = "DELETE FROM student_modules WHERE (student_id = :np_student_id) AND (module_id = :np_module_id)";
$statement = $db->prepare($queryStudents);
$statement->bindValue(":np_student_id", $student_id);
$statement->bindValue(":np_module_id", $module_id);
$statement->execute();
$statement->closeCursor();


$updateQuery = "update students set gpa = (SELECT avg(grade) FROM `student_modules` where student_id=$student_id) where student_id=$student_id ";
$statement = $db->prepare($updateQuery);
$statement->bindValue(":np_student_id", $student_id);
$statement->execute();
$statement->closeCursor();

include("index.php");
?>