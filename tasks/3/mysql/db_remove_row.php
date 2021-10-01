<?php
include('db_connect.php');
//include('db_create.php');
//include('db_create_table.php');

$db = "subscribers";
mysqli_select_db( $conn, $db );

//$sql = "DROP TABLE IF EXISTS subscribers";
//$conn->query($sql); 

$id = $_POST['id'];

if ($id !== ""){
    $sql = "DELETE FROM subscribers WHERE id = '".intval($id)."'";
    $conn->query($sql); 
    echo "data: " . $id;
}
$conn->close();
?>