<?php

session_start();

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
// Create database
if (isset($_POST['submit'])) {
    $user = $_POST["user"];
    $pass = $_POST ["pass"];

    $query = "SELECT USER, PASSWORD FROM login WHERE USER='$user' AND PASSWORD='$pass'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    if ($row) {

        if ($row['user' == $user]) {
            $COOKIE_name = "user";
            $COOKIE_value = "$user";
            setcookie($COOKIE_name, $COOKIE_value, time() + (84600 * 30), "/");
            $_SESSION['user'] = '$user';

            header("location:/contactlist.php", 301);
        }
    } else {

        header("location:/index.php", 301);
    }
}
?>
