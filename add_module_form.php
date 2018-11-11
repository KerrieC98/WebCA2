
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>College Hub</title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="http://example.com/favicon.png">
    </head>
    <body>
        <?php
        include("header.php");
        ?>
        
        <?php //if jquery fails, php can still alert the user to fill in the form properly
        if (!empty($error)) {
            echo "<span class='error'>" . $error . "</span>";
        }
        ?>
            <form id="moduleForm" action="add_module.php" method="post">
                <label>Module Name:</label>
                <input id="moduleName" type="text" name="moduleName"/>
                <div id = "noName">*</div>
                <label>Module Credits:</label>
                <input id="moduleCredits" type="number" name="moduleCredits"/>
                <div id="noCredits">*</div><br>
                <label>Type:</label>
                <select name="moduleType">

                    <option value="Mandatory">Mandatory</option>
                    <option value ="Elective">Elective</option>
                </select>
                <br>
                <input id="addModule" type="submit" value="Add Module"/>
                
            </form>
    <a id="homeLink" href="index.php">Return to homepage</a>
    <?php include("footer.php"); ?>
    </body>
</html>