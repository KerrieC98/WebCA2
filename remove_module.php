<?php
require_once("database.php");

$module_id = filter_input(INPUT_POST, "module");

$queryDeleteModule = "DELETE FROM modules WHERE module_id = :np_module_id";
$statement = $db->prepare($queryDeleteModule);
$statement->bindValue(":np_module_id", $module_id);
$statement->execute();
$statement->closeCursor();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>College Hub</title>
        <link rel="icon" href="http://example.com/favicon.png">
    </head>
    <body>
        <?php include("header.php"); ?>
        <h1>Module Deleted Successfully!</h1>

        <div id="centered">
            <a href="index.php">Return to the home page</a>
            <p> or </p>
            <a href="remove_module_form.php">remove another module.</a>
        </div>
    <?php include("footer.php"); ?>
    </body>
</html>
