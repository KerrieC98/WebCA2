<?php 
require_once("database.php");

$queryStudents = "SELECT * FROM modules";
$statement = $db->prepare($queryStudents);
$statement->execute();
$modules_array = $statement -> fetchAll(); //Multidimensional array
$statement->closeCursor();

$queryUnassignedStudents = "SELECT first_name, last_name, student_id FROM students WHERE gpa = 0.00";
$statement = $db->prepare($queryUnassignedStudents);
$statement->execute();
$unassignedStudents = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>College Hub</title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <script src="jquery/jquery.js" type="text/javascript"></script>
        <link rel="icon" href="http://example.com/favicon.png">
    </head>
    <body>
        <?php include("header.php"); ?>
        <?php
        if (!empty($error)) {
            echo "<span class='error'>" . $error . "</span>";
        }
        ?>
       
            <h1>Assign Student to Module</h1>
            
            <h3 id="unassignedStudentHeader">Students not assigned to any modules</h3>
            
            <ul>
                <?php foreach ($unassignedStudents as $us_row) : ?>
                <li id="unassignedStudentList"><?php echo $us_row["first_name"], " ",  $us_row["last_name"], ", ID: ", $us_row["student_id"]; ?></li>
                <?php endforeach; ?>
            </ul>
            
           
            <form id="addStudentModuleForm" action="add_student_module.php" method="post">
                <label>Module:</label>
                <!--Drop down list populated from the categories table -->
                <select name="module_id"> <!-- Select = Dropdown -->
                    <?php foreach($modules_array as $module_row): ?>
                    <option value="<?php echo $module_row["module_id"]; //Column name?>">
                    <?php echo $module_row["module_name"]; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <br/>
                <label>Student id:</label>
                <input id="studentId" type="number" name="student_id"/>
                <div id="noId">*</div><br>
                <label>Grade:</label>
                <input id="grade" type="number" name="grade" />
                <div id="noGrade">*</div><br>
              
                <input type="submit" value="Assign Student"/>
            </form>
        
    <a id="homeLink" href="index.php">Return to homepage</a>
    <?php include("footer.php"); ?>
    </body>
</html>
