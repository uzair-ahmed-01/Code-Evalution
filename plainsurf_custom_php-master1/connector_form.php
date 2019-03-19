<?php

$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "form";

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection Failed" . $conn->connect_error);
}
echo 'connection Successfull ';

$First_Name = $_POST["firstname"];
$Last_Name = $_POST["lastname"];
$Email = $_POST["email"];
$Mobile = $_POST["mobile"];
$Details = $_POST["details"];
$Opt = $_POST ["opt"];

$currentDir = getcwd();
$uploadDirectory = "/uploads/" . $fileName;

$errors = []; // Store all foreseen and unforseen errors here

$fileExtensions = ['jpeg', 'jpg', 'png','pdf','txt']; // Get all the file extensions

$fileName = time() . mt_rand(0, 1000) . basename($_FILES['myfile']['name']);
$fileSize = $_FILES['myfile']['size'];
$fileTmpName = $_FILES['myfile']['tmp_name'];
$fileType = $_FILES['myfile']['type'];
$fileExtension = strtolower(end(explode('.', $fileName)));

$uploadPath = $currentDir . $uploadDirectory . basename($fileName);

if (isset($_POST['submit'])) {

    if (!in_array($fileExtension, $fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 2000000) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            echo "The file " . basename($fileName) . " has been uploaded";
            $sql = "INSERT INTO contact (First_Name,Last_Name,Email,Mobile,Details,Opt,myfile) VALUES ('$First_Name','$Last_Name','$Email','$Mobile','$Details','$Opt','$fileName')";
            if (mysqli_query($conn, $sql)) {
                echo "records saved successfully";
            } else {
                echo 'not saved';
            }
            header("location:/contact.php", 301);
        } else {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
}
?>