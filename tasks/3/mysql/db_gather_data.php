<?php
include('db_connect.php');

$db = "subscribers";
mysqli_select_db( $conn, $db );

$sql = "SELECT * FROM subscribers";
$result = $conn->query($sql);

while($row = $result->fetch_assoc())
{
    $rows[] = $row;
}

echo json_encode($rows);
$conn->close();
?>