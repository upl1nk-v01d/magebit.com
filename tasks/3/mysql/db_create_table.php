 <?php
include('db_connect.php');

$db = "subscribers";

mysqli_select_db( $conn, $db );

$sql = "CREATE TABLE subscribers (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50) NOT NULL, reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

if ($conn->query($sql) === TRUE) {
  echo "Table subscribers created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

$conn->close();
?>