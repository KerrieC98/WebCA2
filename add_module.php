<?php
require_once("database.php");

$module_name = filter_input(INPUT_POST, "moduleName");
$module_credits = filter_input(INPUT_POST, "moduleCredits");
$module_type = filter_input(INPUT_POST, "moduleType");

 if($module_name == NULL || $module_credits == NULL || $module_type == NULL)
  {
  $error = "Please enter all of your data before submitting the form";
  include("add_module_form.php");
  exit;
  } 

$insertQuery2 = "INSERT INTO modules(module_name, credits, type)"
        . "VALUES (:np_name, :np_credits, :np_type)";
$statement = $db->prepare($insertQuery2);
$statement->bindValue(":np_name", $module_name);
$statement->bindValue(":np_credits", $module_credits);
$statement->bindValue(":np_type", $module_type);
$statement->execute();
$statement->closeCursor();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>College Hub</title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <script src="jquery/jquery.js" type="text/javascript"></script>
        <link rel="icon" href="http://example.com/favicon.png">
    </head>
    <body>
        <?php include("header.php"); ?>
        
            <h1>Module Successfully Added!</h1>
            <div id="centered">
            <a href="index.php">Return to the home page</a>
            <p> or </p>
            <a href="add_module_form.php">add another module.</a>
            </div>
        <?php include("footer.php"); ?>
    </body>
</html>
