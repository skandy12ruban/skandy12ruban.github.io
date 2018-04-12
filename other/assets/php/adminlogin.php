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
  $uname = $password = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $uname = $_POST["uname"];
        $pwd = $_POST["password"];
        $sql = "SELECT * FROM `Admin` WHERE `Username` = '$uname' AND `Password` = '$pwd'";
        $result = $conn->query($sql) or die($conn->error);
        if (!$result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
                if($result->num_rows > 0)
                {
                    header("Location: /admindash.html);
                }
        $conn->close();
    }
}
?>