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
            $id = $_POST["id"];
            $newid = $_POST["courseid"];
            $newname = $_POST["coursename"];
            $sql = "UPDATE `courses` SET 
            `Course_ID`= '$newid',
            `Name`= '$newname'
            WHERE `Course_ID`= '$id'";
            if($conn->query($sql)==TRUE)
            {
              $old = $_SERVER['DOCUMENT_ROOT']."/assets/php/uploads/".$id;
              $new = $_SERVER['DOCUMENT_ROOT']."/assets/php/uploads/".$newid; 
                rename($old,$new);
                echo "Successfully updated!";
            }
            else{
                echo "Not updated successfully!";
            }
        }
    } 
?>
