<?php
if(isset($_SESSION['uname'])){
    
        echo "Session name set successfully!";
    }
    else{
        echo "session not yet set!";
    }
?>