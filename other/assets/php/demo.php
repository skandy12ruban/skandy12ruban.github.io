<?php
$datestr="2018-12-12 00:00:00";//Your date
$date=strtotime($datestr);//Converted to a PHP date (a second count)

//Calculate difference
$diff=$date-time();//time returns current time in seconds
$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours=round(($diff-$days*60*60*24)/(60*60));

//Report
if($days >= 0 ){
echo "$days days $hours hours remain<br />";
}
?>