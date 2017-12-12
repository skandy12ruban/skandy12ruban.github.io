<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="GET")
{
    $uname = $_GET["name"];
}
if (isset($_GET['logout'])) {
   session_destroy();
   header("location: /index.html"); 
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
      $uemail = $_SESSION["email"];
      $sql = "SELECT c.Course_ID, c.Name, c.Description, c.Start_date, DATE_FORMAT(s.Renewal_date, '%d-%m-%Y') AS Renewal_date, DATE_FORMAT(s.Expiry_date, '%d-%m-%Y') AS Expiry_date, c.Others, c.Status 
              FROM courses c, student s WHERE c.Course_ID = s.Course_ID AND s.Email_ID = '$uemail'";
      $availsql = "SELECT c.Course_ID, c.Name, c.Description, c.Start_date, c.Others, c.Status 
      FROM courses c, student s WHERE c.Course_ID != s.Course_ID AND s.Email_ID != '$uemail'";
      $mycourse = "";
      $availcourse = "";
      $result = $conn->query($sql);
      $availresult = $conn->query($availsql);
      if(!$result){
          echo $conn->error;
      }
      if($result->num_rows > 0)
      {
        while($row = $result->fetch_assoc()) 
        { 
            $renewdatestr = $row['Renewal_date'];
            $renewdate = strtotime($renewdatestr);
            $datestr = $row['Expiry_date'];
            $date=strtotime($datestr);//Converted to a PHP date (a second count)
            //Calculate difference
            $diff=$date-time();//time returns current time in seconds
            $totaltime = $date-$renewdate;
            $totaldays=floor($totaltime/(60*60*24));//seconds/minute*minutes/hour*hours/day)
            $days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
            $hours=round(($diff-$days*60*60*24)/(60*60));
            $percentage = floor((($totaldays - $days) / $totaldays) * 100);
            //Report
             $mycourse = $mycourse . "
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <h3> ".$row["Course_ID"]."-".$row["Name"]."</h3>
                </div>
                <div class='panel-body'>
                    <p>".$row["Description"]."</p>
                </div>
            <div class='panel-footer'>";
            if($days >= 0 ){
            $mycourse = $mycourse . "Expired in <b> $days days $hours hours</b>" .
            "<a class='btn btn-lg btn-success btn-right' href='/course.php?id=".$row["Course_ID"]."'>Resume Course</a>";    
            }
            else{
            $mycourse = $mycourse . "Expired</b>";
            "<a class='btn btn-lg btn-success btn-right' href='/subscribe.php?id=".$row["Course_ID"]."'>Resume Course</a>";                
            }
            $mycourse = $mycourse . "</div></div>";
            $status = "
            <div class='panel panel-default'>
              <div class='panel-heading'>
                <h3> ".$row["Course_ID"]."-".$row["Name"]."</h3>
              </div>
                <div class='panel-body'>
                  <div class='progress'>
                      <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='$percentage' aria-valuemin='0' aria-valuemax='100' style='width:$percentage%'>
                      <span class='sr-only'>$percentage % Complete
                  </div>
                </div>
                <div>
                      Expired in <b> $days days $hours hours</b>
                      <a class='btn btn-lg btn-success btn-right' href='/subscribe.php?id=".$row["Course_ID"]."'>Renew Course</a>               
                </div>
            </div>";
        }  
    }
    else
    {
        $mycourse = $mycourse . "You haven't enrolled any course. Check through available courses and enroll now.";
    }
      if($availresult->num_rows > 0)
      {
        while($arow = $availresult->fetch_assoc()) 
        { 
            $availcourse = $availcourse . "
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <h3> ".$arow["Course_ID"]."-".$arow["Name"]."</h3>
                </div>
                <div class='panel-body'>
                    <p>".$arow["Description"]."</p>
                </div>
                <div class='panel-footer' align='right'>
                    <a class='btn btn-lg btn-success' href='/subscribe.php?id=".$arow["Course_ID"]."'>Enroll Course</a>                
                </div>
            </div>";  
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
    <style>
        html,
        body,
        {
            font-family: 'Lato', sans-serif;
        }
        .btn-info {
            background-color: #7386D5;
        }
        div .btn-right{
            float: right;
        }
        .progress-bar {
  width: 0;
  animation: progress 1.5s ease-in-out forwards;
  
  .title {
    opacity: 0;
    animation: show 0.35s forwards ease-in-out 0.5s;
  }
} 

@keyframes progress {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
} 
@keyframes show  {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Alagar Acadamy</h3>
            </div>

            <ul class="list-unstyled components">
                <h4 align="center">
                    <?php
                    echo "Welcome </br>";
                    echo $uname;?>
             </h4>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"> <i class="fa fa-graduation-cap" aria-hidden="true"></i>Courses</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="#" id="mycoursemenu">My Courses</a></li>
                        <li><a href="#" id="availcoursemenu">Available Courses</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#subsSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fa fa-rss" aria-hidden="true"></i>Subscription</a>
                    <ul class="collapse list-unstyled" id="subsSubmenu">
                        <li><a href="#" id="substatusmenu">Subscription Status</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>Profile</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="#" id="editprofilemenu">Edit profile</a></li>
                        <li><a href="#" id="changecredmenu">Change credentials</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- Page Content Holder -->
        <div id="content" class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">                             
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>Menu</span>
                            </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/studentdash.php?logout=true"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="coursecontent">
                <div id="courses">
                    <div id="mycourse">
                        <h3>My course</h3>
                        <hr>
                        <?php echo $mycourse;?>
                    </div>
                    <div id="availcourse">
                    <h3>Available course</h3>
                        <hr>
                        <?php echo $availcourse;?>
                    </div>
                </div>
                <div id="subscription">
                    <div id="substatus">
                        <h3>Subscription Status</h3>
                        <hr>
                        <?php echo $status;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<!-- Bootstrap Js CDN -->
<script src="//code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
       $("#courses").show();
       $("#mycourse").siblings().hide();
       $("#courses").siblings().hide();
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
        $('#substatusmenu').on('click',function(){
            $("#subscription").show();
            $("#substatus").show(1000);
            $("#substatus").siblings().hide(1000);
            $("#substatus").parent().siblings().hide(1000);
        });
        $('#mycoursemenu').on('click',function(){
            $("#courses").show(1000);
            $("#mycourse").show(1000);
            $("#mycourse").siblings().hide(1000);
            $("#mycourse").parent().siblings().hide(1000);
        });
        $('#availcoursemenu').on('click',function(){
            $("#course").show(1000);
            $("#availcourse").show(1000);
            $("#availcourse").siblings().hide(1000);
            $("#availcourse").parent().siblings().hide(1000);
        });
    });
</script>

</html>