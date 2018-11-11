<?php
require_once("database.php");

$student_id = filter_input(INPUT_POST, "student_id");

if (!isset($student_id)) {
    $error = "Please select a student to remove.";
    include("index.php");
    exit();
}

$queryStudentId = "DELETE FROM students WHERE student_id = :np_student_id";
$statement = $db->prepare($queryStudentId);
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
        <h1>Student Removed Successfully!</h1>
        <div id="centered">
            <a id="homeLink" href="index.php">Return to the homepage</a>
        </div>
        <?php include("footer.php"); ?>
    </body>
</html>
