<?php

$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "form";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "DELETE FROM contact WHERE id = $_GET[id]";

if(mysqli_query($conn, $sql))
{   
    header("refresh:1;url=contactlist.php");
  
}
 else {
    echo 'NOT INSERTED';    
}

?>