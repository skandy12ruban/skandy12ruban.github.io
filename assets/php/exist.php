<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alagaracadamy";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else{
        $sql = "SELECT Name FROM `Users` WHERE `Email` = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
            return $result;
        }
    }
?>