<?php
$servername = "localhost";
$username = "root";
$password = "test12345";
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error) . "<br>"; }
?>