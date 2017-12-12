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
    if($_SERVER["REQUEST_METHOD"] == "POST" )
        { 
            $name = $_POST["name"];
            $uname = $_POST["uname"];
            $pwd = $_POST["pwd"];
            $sql = "INSERT INTO `admin` (`Name`, `Username`, `Password`) VALUES ('$name', '$uname', '$pwd')";
            if($conn->query($sql) ==TRUE){
                echo "Admin: ". $name . " has been successfully added.";
            }else{
                echo "Admin: ". $name . " not added. Fill the form again";
            }
        }
    }
?>
