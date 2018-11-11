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
        <h1>Whoops!</h1>
        <?php
        echo $error_message;
        echo "<br><br>";
        echo $error;
        echo "<br><a id=homeLink href=index.php>Return to the homepage</a>";
        include("footer.php");
        ?>
    </body>
</html>
