<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alagaracadamy";
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else{
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    $email = $_GET['email']; // Set email variable
    $hash = $_GET['hash']; // Set hash variable
    $sql = "SELECT Email, Hash, Verified FROM Users WHERE email='".$email."' AND hash='".$hash."' AND Verified='0'";
    $result = $conn->query($sql);  
    if($result->num_rows > 0)
    {
        $sql = "UPDATE Users SET Verified='1' WHERE Email='".$email."' AND Hash='".$hash."' AND Verified='0'";
        if($conn->query($sql)){
            $show = "Your account is activated!";
            $redirect = "<p align='center'><a href='/homedash.html?email=".$email.">Click here</a> to redirect to your dashboard.</p>";    
            header( "refresh:10;url=/index.html" );
        }
        else{
            $show = "error in sql!";
        }
    }
    else{
        $show = "Problem in activation!";
    }
}
else{
    $show = "Invalid approach";
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
            <?php echo $redirect?>
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