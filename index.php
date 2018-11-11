<?php
require_once ("database.php");

$queryStudents = "SELECT * from modules ORDER BY module_id";
$statement = $db->prepare($queryStudents);
$statement->execute();
$modules = $statement->fetchAll();
$statement->closeCursor();

if (!isset($module_id)) {
    $module_id = filter_input(INPUT_GET, 'module_id', FILTER_VALIDATE_INT);

    if ($module_id == NULL || $module_id == FALSE) {
        $module_id = 1;
    }
}

$queryModule = 'SELECT * FROM modules '
        . 'WHERE module_id = :module_id';
$statement1 = $db->prepare($queryModule);
$statement1->bindValue(':module_id', $module_id);
$statement1->execute();
$module = $statement1->fetch();
$module_name = $module['module_name'];
$statement1->closeCursor();

$queryAverageGrade = "SELECT avg(grade) FROM students, student_modules"
        . " WHERE student_modules.student_id = students.student_id"
        . " AND module_id = $module_id";
$statement3 = $db->prepare($queryAverageGrade);
$statement3->execute();
$averageGrade = $statement3->fetch();
$statement3->closeCursor();

$sort = filter_input(INPUT_POST, "sortBy");

if (empty($sort) || $sort == "student_id") {
    $queryStudents = "SELECT * FROM students, student_modules"
            . " WHERE student_modules.student_id = students.student_id"
            . " AND module_id = $module_id"
            . " ORDER BY students.student_id"; //necessary to specifiy table because more than one has the field student_id
} else if ($sort == "grade") {
    $queryStudents = "SELECT * FROM students, student_modules"
            . " WHERE student_modules.student_id = students.student_id"
            . " AND module_id = $module_id"
            . " ORDER BY " . $sort . " DESC"; //separate clause for grade because it needs to be sorted descending
} else {
    $queryStudents = "SELECT * FROM students, student_modules"
            . " WHERE student_modules.student_id = students.student_id"
            . " AND module_id = $module_id"
            . " ORDER BY " . $sort . " ASC";
}

$statement4 = $db->prepare($queryStudents);
$statement4->execute();
$students = $statement4->fetchAll();
$statement4->closeCursor();
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
        <link rel="icon" href="images/graduation-cap.png">
    </head>
    <body>
        <?php
        include("header.php");
        ?>
        <div id="error">
            <?php
            if (isset($error)) {
                echo $error;
            }
            ?>
        </div>
        <div id="moduleList">
            <?php foreach ($modules as $module): ?>
                <li><a href=".?module_id=<?php echo $module['module_id']; ?>">
                        <?php echo $module['module_name']; ?>
                    </a>
                    <input form="myForm" type="hidden" name="module_id" value="<?php echo $module['module_id']; ?>" />
                </li>
            <?php endforeach; ?>
        </div>

        <section>
            <h2 id="module_name">
                <?php echo $module_name; ?>
            </h2>

            <div id="sorting">
                <form action="" method="POST">
                    <select id="sort" name="sortBy">
                        <option value="student_id">ID</option>
                        <option value="first_name">First Name</option>
                        <option value="last_name">Last Name</option>
                        <option value="grade">Grade</option>
                    </select>
                    <input type="submit" value="Sort!" />
                </form>

            </div>
            <table id="indexTable">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Grade</th>
                    <th>GPA</th>
                </tr>
                <?php foreach ($students as $s_row) : ?>
                    <tr>
                        <td><?php echo $s_row["student_id"]; ?></td>
                        <td><?php echo $s_row["first_name"]; ?></td>
                        <td><?php echo $s_row["last_name"]; ?></td>
                        <td><?php echo $s_row["gender"]; ?></td>
                        <td><?php echo $s_row["email"]; ?></td>
                        <td><?php echo $s_row["grade"]; ?></td>
                        <td><?php echo $s_row["gpa"]; ?></td>


                        <td>
                       
                            <form onsubmit="return confirm('Are you sure you wish to remove this student from the selected module?');" id='myForm' action="remove_student_module.php" method="POST">
                                <input type="hidden" id="studentID" name="student_id" value="<?php echo $s_row["student_id"]; ?>" />
                                <input type="hidden" name="module_id" value="<?php echo $module_id; ?>"/>
                                <input type="submit" value="Remove" />
                            </form>
                        </td>

                        <td>
                 
                            <form id='studentPageForm' action="student.php" method="POST">
                                <input type="hidden" id="studentID" name="student_id" value="<?php echo $s_row["student_id"]; ?>" />
                                <input type="hidden" name="module_id" value="<?php echo $module_id; ?>"/>
                                <button type="submit">
                                    <img src="images/studentIcon.png" title="Student Info" width="20" height="30" alt=""/>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div id="classStatistics">
                <?php
                echo "Total number of students taking this module: ", count($students), "<br>";
                echo "Average grade of students taking this module: ", round($averageGrade[0]), "%";
                ?>
            </div>
        </section>
        <div id="nav">
            <ul class="navBar">
                <li class="navBarList"><a class="navBarLink" href="add_student_form.php">Add Students</a></li>
                <li class="navBarList"><a class="navBarLink" href="add_module_form.php">Add Modules</a></li>
                <li class="navBarList"><a class="navBarLink" href="add_student_module_form.php">Assign Students to Modules</a></li>
                <li class="navBarList"><a class="navBarLink" href="remove_module_form.php">Remove Modules</a></li>
            </ul>
        </div>

        <form id="studentForm" action="student.php" method="POST">
            <input class="indexButton" type="hidden" name="student_id" value="<?php echo $s_row["student_id"]; ?>" />
        </form>
        <?php
        include("footer.php");
        ?>
    </body>
</html>
