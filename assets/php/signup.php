<?php 
require 'mail.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alagaracadamy";
$account = "alagaracadamyindia@gmail.com";
$pwd = "alagar123";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else{
    $fname = $lname = $name = $email = $gender = $password = $dob = $location = $telno = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $gender = $_POST["gender"];
        $hash = md5( rand(0,1000) );
        $password = $_POST["password"];
        $dob = $_POST["dob"];
        $location = $_POST["location"];
        $telno = $_POST["telno"];
        $sql = "SELECT Name FROM `Users` WHERE `Email` = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
           $show = "Email already exists!";
           $redirect = "<p align='center'><a href='/alagaracadamy/signup.html'>Click here</a> to create your account.</p>";
           header( "refresh:10;url=/signup.html" );
        }
        else{
        $sql = "INSERT INTO `Users`(`Name`, `Lname` , `Email`, `Password`, `DOB`, `Gender`, `Telno`, `Location`,`Hash`) VALUES ('$fname','$lname','$email','$password','$dob','$gender','$telno','$location','$hash')";
        
        if ($conn->query($sql) === TRUE) {
            $message = '
           Thanks for signing up!
           Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
            
           ------------------------
           Username: '.$fname.'
           Email: '.$email.'
           ------------------------
            
           Please click this link to activate your account:
           http://www.alagaracadamy.com/assets/php/verify.php?email='.$email.'&hash='.$hash.'
           ';
           $subject = 'Signup | Verification Email for Alagar Acadamy'; 
           if(smtpmailer($email, $subject, $message))
         { // Send our email
           $show = "Welcome " . $fname .", your account has been successfully created.</br>Verification email will be sent to your email.";
           $redirect = "<p align='center'><a href='/index.html'>Click here</a> to redirect to home page.</p>";
           header( "refresh:10;url=/login.html" );
           
        }
         else{
            $show = "Welcome " . $fname .", your account has been successfully created.</br>Verification email not yet sent to your email.";
            $redirect = "<p align='center'><a href='/index.html'>Click here</a> to redirect to home page.</p>";
              
         }
        }else {  
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
        $conn->close();
    }

}
?>
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="../css/style.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html,
        body,
        section {
            font-family: 'Lato', sans-serif;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-default" style="background-color:#F1F1F1 ">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                <a href="#" class="navbar-brand" style="color:black; font-size:20px;">Alagar Acadamy </a>
            </div>
            <!-- Collection of nav links and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/index.html" style="color:black; font-size:15px ;">Home</a></li>
                    <li><a href="/aboutus.html" style="color:black; font-size:15px; ">About Us</a></li>
                    <li><a href="/buisness.html" style="color:black; font-size:15px; ">Business</a></li>
                    <li><a href="/contact.html" style="color:black; font-size:15px; ">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="/signup.html" style="color:black; font-size:15px; "><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="/login.html" style="color:black; font-size:15px; "><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section style="color:black">
        <div class="container">
            <h3 align="center">
                <?php echo $show?>
            </h3>
            <?php echo $redirect ?>
    </div>
    </section>
    <section style="background-color:#F1F1F1;bottom:0;position:absolute;width:100%;">
        <footer>
            <div>
                <p align="center">
                    <a href="">Privacy</a> |
                    <a href="">Terms</a>
                </p>
                <p align="center">
                    &copy;2017, Orange Consultants Pvt. Ltd. <br> All copyrights Reserved.
                </p>
            </div>
        </footer>
    </section>
    </body>
    </html>