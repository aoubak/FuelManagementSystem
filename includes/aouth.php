<?php

// session_start();

function checkLogin() {
    if(isset($_SESSION['employeeID']) == False){
        header("location:login.php");
        exit();
    }
}


?>