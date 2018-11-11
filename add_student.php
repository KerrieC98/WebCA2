<?php
require_once("database.php");

$first_name = filter_input(INPUT_POST, "first_name");
if(!isset($first_name))
    {
        include("add_student_form.php");
        exit();
    }
$last_name = filter_input(INPUT_POST, "last_name");
$gender = filter_input(INPUT_POST, "gender");
$email = filter_input(INPUT_POST, "email");

if($last_name == NULL || $gender == NULL || $email == NULL)
  {
  $error = "Please enter all of your data before submitting the form";
  include("add_student_form.php");
  exit;
  } 

$insertQuery = "INSERT INTO students(first_name, last_name, gender, email) "
        . "VALUES (:np_first_name, :np_last_name, :np_gender, :np_email)";
$statement = $db->prepare($insertQuery);
$statement->bindValue(":np_first_name", $first_name);
$statement->bindValue(":np_last_name", $last_name);
$statement->bindValue(":np_gender", $gender);
$statement->bindValue(":np_email", $email);
$statement->execute();
$statement->closeCursor();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>College Hub</title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="http://example.com/favicon.png">
    </head>
    <body>
        <?php include("header.php"); ?>
            
            <h1>Student Added Successfully</h1>
            <div id="centered">
            <a href="index.php">Return to the home page</a>
            <p> or </p>
            <a href="add_student_form.php">add another student.</a>
            </div>
        <?php include("footer.php"); ?>
    </body>
</html>