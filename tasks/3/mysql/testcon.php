<?php

function cl($txt) {
    echo "$txt";
    echo '<script>console.log("' . $txt . '")</script><br>';
} 

$servername = "localhost";
$username = "root";
$password = "test12345";
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) { cl("Connection failed: " . $conn->connect_error); }
cl ("Connection successful");
?>