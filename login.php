<?php
session_start();
if(isset($_SESSION["email"])){
    $variable = $_SESSION["email"];
    $variable = substr($variable, 0, strpos($variable, "@"));
    $url = "Location: /studentdash.php?user=".$_SESSION["email"]."&name=".$variable;
    header($url);
} 
?>
<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="assets/css/style.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
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
                    <li><a href="/signup.html" style="color:black; font-size:15px; "><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li class="active"><a href="/login.html" style="color:black; font-size:15px; "><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section style="color:black">
        <div class="container">
            <h2 align="center">Login to your Account.</h2>
            <div class="row" style="padding-top:20px">
                <div class="col-md-4 col-md-offset-4" class="jumbotron" style="background-color:#F1F1F1;padding-top:20px">
                    <form method="POST" action="assets/php/login.php">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Username@email.com" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group form-inline">
                            <label><input class="btn btn-info" type="checkbox"/> Remember me.</label>
                            <a href="passforgot.html" style="float:right">forgot password?</a>
                        </div>
                        <div class="form-group" align="center">
                            <input class="btn btn-info" type="submit" value="Login" />
                        </div>
                    </form>
                </div>
            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        $(".checkbox").change(function() {
            if (this.checked) {
                var user = $("#email").val();
                localStorage.setItem("login_user", user);
            }
        });
    });
</script>

</html>