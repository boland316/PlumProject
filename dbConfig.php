<?php
//db details
$dbHost = '127.0.0.1';
$dbUsername = 'boland316';
$dbPassword = '';
$dbName = 'Events';

//Connect and select the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>