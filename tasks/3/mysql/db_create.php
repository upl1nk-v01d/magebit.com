<?php
include('db_connect.php');

$db = "CREATE DATABASE subscribers";
if ($conn->query($db) === TRUE) { echo "Database created successfully<br>";} else { echo "Error creating database: " . $conn->error; }

$conn->close();
?>