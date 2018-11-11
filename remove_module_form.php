<?php
require_once("database.php");

$queryModuleId = "SELECT module_id, module_name FROM modules";
$statement = $db->prepare($queryModuleId);
$statement->execute();
$moduleId = $statement->fetchAll();
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
        <?php include("header.php");
        ?>
        <form onsubmit="return confirm('Are you sure you wish to remove this module?');" action="remove_module.php" method="POST">
            <label>Module:</label>
            <select name="module">
                <?php foreach ($moduleId as $mi_row) : ?>
                    <option value="<?php echo $mi_row["module_id"]; ?>"><?php echo $mi_row["module_name"]; ?></option>
<?php endforeach; ?>
            </select>
            <br>
            <input type="submit" value="Remove Module">
        </form>
    
    <a id="homeLink" href="index.php">Return to homepage</a>
    </body>
</html>
