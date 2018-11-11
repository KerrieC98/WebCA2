<?php
require_once("database.php");

$module_id = filter_input(INPUT_POST, "module_id");

$student_id = filter_input(INPUT_POST, "student_id");
$grade = filter_input(INPUT_POST, "grade");

$queryTotalStudents = "SELECT max(student_id) FROM students";
$statement = $db->prepare($queryTotalStudents);
$statement->execute();
$highestId = $statement->fetch();
$statement->closeCursor();

if ($module_id == NULL || $student_id == NULL || $grade == NULL) {
    $error = "Please enter all of your data before submitting the form";
    include("add_student_module_form.php");
    exit;
} else if ($grade > 100 || $grade < 0) {
    $error = "The grade must be a number between 0 and 100";
    include("add_student_module_form.php");
    exit;
} else if ($student_id > $highestId[0]) {
    $error = "Please enter a valid student ID";
    include("add_student_module_form.php");
    exit;
}


try {
    $insertQuery = "INSERT INTO student_modules(module_id, student_id, grade) "
            . "VALUES (:np_module_id, :np_student_id, :np_grade)";
    $statement = $db->prepare($insertQuery);
    $statement->bindValue(":np_module_id", $module_id);
    $statement->bindValue(":np_student_id", $student_id);
    $statement->bindValue(":np_grade", $grade);
    $statement->execute();
    $statement->closeCursor();
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    $error = "An error has occurred while attempting to assign a student to a module. Please ensure that you are not assigning a student to a "
            . "module they are already assigned to, or are assigning a student that does not exist.";
    include("error.php");
    exit();
}
//Update student gpa
$updateQuery = "UPDATE students set gpa = (SELECT avg(grade) FROM student_modules WHERE student_id=$student_id) WHERE student_id=$student_id ";
$statement = $db->prepare($updateQuery);
$statement->bindValue(":np_student_id", $student_id);
$statement->execute();
$statement->closeCursor();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>College Hub</title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script src="jquery/jquery.js" type="text/javascript"></script>
        <link rel="icon" href="http://example.com/favicon.png">
    </head>
    <body>
        <?php include("header.php"); ?>
        <h1>Student Added Successfully!</h1>
        <div id="centered">
            <a href="index.php">Return to the home page</a>
            <p> or </p>
            <a href="add_student_module_form.php">assign another student to a module.</a>
        </div>
        <?php include("footer.php"); ?>
    </body>
</html>
