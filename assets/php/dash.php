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
        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            if($_GET["action"]=="list")
            {
                $sql = "SELECT Course_ID, Name FROM courses";
                $result = $conn->query($sql);
                echo "<table class='table table-striped table-hover '><tr><th>Course ID</th><th>Course Name</th></tr>";
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr> <td>". $row["Course_ID"]. "</td><td>". $row["Name"]. "</td></tr>";
                    }                
                    echo "</table>";
                }
                else 
                {
                        echo  "0 results";
                }
            }
            else if($_GET["action"]=="edit")
            {
                $sql = "SELECT Course_ID FROM `courses`";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<option></option>";
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row["Course_ID"]. "'>". $row["Course_ID"]. "</option>";
                    }               
                }
                else 
                {
                    echo "<option>No option</option>";
                    ;
                }
            }
            else if($_GET["action"]=="edititem")
            {
                $id = $_GET["id"];
                $sql = "SELECT `Course_ID`, `Name` FROM `courses` WHERE `Course_ID` = '$id'";
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo "<table class='table table-striped'><tr><th>Course ID</th><th>Course Name</th></tr>";            
                        while($row = $result->fetch_assoc()) {
                        echo "<tr> <td contenteditable='true' id='newid'>". $row["Course_ID"]. "</td><td contenteditable='true' id='newname'>". $row["Name"]. "</td></tr>";
                    }                
                    echo "</table>";
                }
                else 
                {
                        echo  "0 results";
                }
            }
            else if($_GET["action"]=="removeitem")
            {
                $id = $_GET["id"];
                $sql = "DELETE FROM `courses` WHERE `Course_ID` = '$id'";
                $path = $_SERVER["DOCUMENT_ROOT"]."/assets/uploads/".$id;
                if($conn->query($sql)==TRUE){
                    delete_files($path);
                    echo "Successfull removed";
                }
            }
            else if($_GET["action"]=="studentlist")
            {
                $sql = "SELECT Name, Email, Telno FROM users";
                $result = $conn->query($sql);
                echo "<table class='table table-striped table-hover '><tr><th>Name</th><th>Email</th><th>Telno</th></tr>";
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr> <td>". $row["Name"]. "</td><td>". $row["Email"]. "</td><td>". $row["Telno"]. "</td></tr>";
                    }                
                    echo "</table>";
                }
                else 
                {
                        echo  "0 results";
                }
            }
            if($_GET["action"]=="adminlist")
            {
                $sql = "SELECT * FROM admin";
                $result = $conn->query($sql);
                $num = 0;
                echo "<table id='admintable' class='table table-striped table-hover '><tr><th>Name</th><th>Username</th><th>Password</th></tr>";
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr id='$num'><td>". $row["Name"]. "</td><td>". $row["Username"]. "</td><td>". $row["Password"]. "</td><td></tr>";
                        $num++;
                    }                
                    
                    echo "</table>";
                }
                
                else 
                {
                        echo  "0 results";
                }
            }
            
        }
        if($_SERVER["REQUEST_METHOD"] == "POST" )
        {                 
                $id = $_POST["courseid"];
                $name = $_POST["coursename"];
                $describe = $_POST["coursedescribe"];
                $others = $_POST["others"];
                $today = date("d-m-Y");
                if($today > $start){
                    $status = "active";
                }
                else{
                    $status = "Inactive";
                }
                $sql = "INSERT INTO `courses` (`Course_ID`, `Name`, `Description`, `Others` , `Status`) VALUES ('$id', '$name', '$describe', '$others', '$status')";
              if($conn->query($sql) ==TRUE){
                  mkdir($_SERVER['DOCUMENT_ROOT']."/assets/php/uploads/".$id,0777);             
            echo "Course: ". $name . " has been successfully added.";
            }
            else
            {
            echo "Course: ". $name . " not added. Fill the form again";
                }
            
        }
    }        
    function delete_files($target) {
        if(is_dir($target)){
            $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
            foreach( $files as $file )
            {
                delete_files( $file );      
            }
            rmdir( $target );
        } elseif(is_file($target)) {
            unlink( $target );  
        }
    }
?>