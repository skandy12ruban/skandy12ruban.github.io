<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="GET")
{
    $courseid = $_GET["id"];
    $uemail = $_SESSION["email"];
}
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
    $sql = "SELECT * FROM courses WHERE Course_ID = '$courseid'";
    $result = $conn->query($sql);
    if(!$result){
        echo $conn->error();
    }
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $coursename = $row["Name"];
            $description = $row["Description"];
            $startplan = $row["Starter_plan"];
            $regularplan = $row["Regular_plan"];
            $proplan = $row["Pro_plan"];
        }
    }
}
?>
    <html>

    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="assets/css/style.css" type="text/css" rel="stylesheet">
        <link href="assets/css/style1.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="btn btn-danger navbar-btn">                             
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>Go Back</span>
                            </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/studentdash.php?logout=true"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="panel panel-default" align="center">
                <div class="panel-heading">
                    <h3><?php echo $courseid . "-" . $coursename;?></h3>    
                </div>
                <div class="panel-body">
                    <p class="lead"><?php echo $description;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">

                    <!-- PRICE ITEM -->
                    <div class="panel panel-danger price panel-red">
                        <div class="panel-heading  text-center">
                            <h3>PRO PLAN</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p class="lead" style="font-size:40px"><strong>&#8377; <?php echo $proplan;?> /-</strong></p>
                        </div>
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item"><i class="icon-ok text-danger"></i> Personal use</li>
                            <li class="list-group-item"><i class="icon-ok text-danger"></i> Unlimited projects</li>
                            <li class="list-group-item"><i class="icon-ok text-danger"></i> 27/7 support</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-danger" href="#">BUY NOW!</a>
                        </div>
                    </div>
                    <!-- /PRICE ITEM -->


                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">

                    <!-- PRICE ITEM -->
                    <div class="panel price panel-info">
                        <div class="panel-heading arrow_box text-center">
                            <h3>DEV PLAN</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p class="lead" style="font-size:40px"><strong>$20 / month</strong></p>
                        </div>
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item"><i class="icon-ok text-info"></i> Personal use</li>
                            <li class="list-group-item"><i class="icon-ok text-info"></i> Unlimited projects</li>
                            <li class="list-group-item"><i class="icon-ok text-info"></i> 27/7 support</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-info" href="#">BUY NOW!</a>
                        </div>
                    </div>
                    <!-- /PRICE ITEM -->
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">

                    <!-- PRICE ITEM -->
                    <div class="panel price panel-success">
                        <div class="panel-heading arrow_box text-center">
                            <h3>FREE PLAN</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p class="lead" style="font-size:40px"><strong>&#8377; <?php echo $starterplan;?> /-</strong></p>
                        </div>
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item"><i class="icon-ok text-success"></i> Personal use</li>
                            <li class="list-group-item"><i class="icon-ok text-success"></i> Unlimited projects</li>
                            <li class="list-group-item"><i class="icon-ok text-success"></i> 27/7 support</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-success" href="#">BUY NOW!</a>
                        </div>
                    </div>
                    <!-- /PRICE ITEM -->


                </div>
            </div>
        </div>
    </body>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="//code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </html>