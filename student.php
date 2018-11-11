<?php
require_once("database.php");
$student_id = filter_input(INPUT_POST, "student_id");

if (!isset($student_id)) {
    $error = "Please select a student before attempting to visit their page.";
    include("index.php");
    exit();
}


$module_id = filter_input(INPUT_POST, "module_id");

$queryStudentInfo = "SELECT * FROM modules, student_modules"
        . " WHERE modules.module_id = student_modules.module_id"
        . " AND student_modules.student_id = $student_id";

$statement = $db->prepare($queryStudentInfo);
$statement->execute();
$studentInfo = $statement->fetchAll();
$statement->closeCursor();

$queryFirstName = "SELECT first_name FROM students"
        . " WHERE student_id = $student_id";
$statement = $db->prepare($queryFirstName);
$statement->execute();
$first_name = $statement->fetch();
$statement->closeCursor();

$queryLastName = "SELECT last_name FROM students"
        . " WHERE student_id = $student_id";
$statement = $db->prepare($queryLastName);
$statement->execute();
$last_name = $statement->fetch();
$statement->closeCursor();

$queryGPA = "SELECT gpa from students"
        . " WHERE student_id = $student_id";
$statement = $db->prepare($queryGPA);
$statement->execute();
$GPA = $statement->fetch();
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

        <?php
        include("header.php");
        ?>
        <div id="studentDetails">
            <?php
        echo "Student Name: ", $first_name[0], " ", $last_name[0];
        echo "<br>GPA: ", $GPA[0];
        ?>
        </div>
        <a id="homeLink" href="index.php">Return to homepage</a>
        <div id="student">
            <table id="studentTable">
                <tr>
                    <th>Module ID</th>
                    <th>Module Name</th>
                    <th>Type</th>
                    <th>Credits</th>
                    <th>Grade</th>
                </tr>
                <?php foreach ($studentInfo as $si_row) : ?>
                    <tr>
                        <td><?php echo $si_row["module_id"]; ?></td>
                        <td><?php echo $si_row["module_name"]; ?></td>
                        <td><?php echo $si_row["type"]; ?></td>
                        <td><?php echo $si_row["credits"]; ?></td>
                        <td><?php echo $si_row["grade"]; ?></td>

                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <form onsubmit="return confirm('Are you sure you wish to remove this student?');" action="remove_student.php" method="POST">
            <input name="student_id" type="hidden" value="<?php echo $student_id ?>">
            <input id="removeStudent" type="submit" value="Remove Student">
        </form>
         
        <?php include("footer.php"); ?>
    </body>
</html>
