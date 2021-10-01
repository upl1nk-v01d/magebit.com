<?php
include('db_connect.php');
//include('db_create.php');
//include('db_create_table.php');

$db = "subscribers";
mysqli_select_db( $conn, $db );

//$sql = "DROP TABLE IF EXISTS subscribers";
//$conn->query($sql); 

$email = $_POST['email'];
$checkbox = isset($_POST['chbox']);
//$email = "x@x.x";
echo "email: " . $email . "<br>";
echo "checbox: " . $checkbox*1 . "<br>";

if ($email == ""){
    echo "Email address is required<br>"; return;
} else if (strpos($email, '@')<1) {
    echo "Please provide a valid e-mail address"; return;
} else if (substr($email, -3) === '.co'){
    echo "We are not accepting subscriptions from Colombia emails"; return;
} else if (!($checkbox)){
    echo "You must accept the terms and conditions"; return;
} else {
    $sql = "SELECT 1 from subscribers LIMIT 1";
    if ($conn->query($sql) !== TRUE) {
        $sql = "CREATE TABLE subscribers (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, email VARCHAR(50) NOT NULL, reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
        
        if ($conn->query($sql) === TRUE) {
          echo "Table subscribers created successfully<br>";
        } else {
          echo "Error creating table: " . $conn->error . "<br>";
        }
    
        $sql = "INSERT INTO subscribers(email) VALUES('".$email."')";
        if ($conn->query($sql) === TRUE) {
          echo "Insertion successfull<br>";
        } else {
          echo "Error inserting to table: " . $conn->error . "<br>";
        }
    }
}

$conn->close();
?>