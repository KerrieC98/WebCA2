
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

        <?php
        if (!empty($error)) {
            echo "<span class='error'>" . $error . "</span>";
        }
        ?>
       
            <h1></h1>
            <form id="addStudentForm" action="add_student.php" method="post">

                <label>First Name:</label>
                <input id="firstName" type="text" name="first_name" pattern="^[^0-9]+$"/>
                <div id="noName">*</div><br>
                <label>Last Name:</label>
                <input id="lastName" type="text" name="last_name" pattern="^[^0-9]+$"/>
                <div id="noLastName">*</div><br>
                <label>Gender:</label>
                <select name="gender">

                    <option value="Male">Male</option>
                    <option value ="Female">Female</option>
                </select>
                <br>
                <label>Email:</label>
                <input id="email" type ="text" name="email" pattern="^.*@dkit.ie.*$"/> <!-- email must contain @dkit.ie -->
                <div id="noEmail">*</div><br>
                <input type="submit" value="Add Student"/>
            </form>
            
                <a id="homeLink" href="index.php">Return to homepage</a>
            
                <?php include("footer.php"); ?>
    </body>
</html>
