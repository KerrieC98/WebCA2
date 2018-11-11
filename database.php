<?php

$dsn = "mysql:host=localhost;dbname=mooble";
$username = "mgs_user";
$password = "pa55word";

try {
    $db = new PDO($dsn, $username, $password);//PHP Data Object
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE); //permission to use prepare statements
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    $error = "Failed to connect to database.";
    echo $error_message;
    include("error.php");
    exit();
}