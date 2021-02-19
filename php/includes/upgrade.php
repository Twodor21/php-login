<?php

session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_POST['upgrade'])){

    if($_SESSION['rankstatus'] == "user"){
        rankchange($conn, "admin");
        header("location: ../../userinfo".$_SESSION['rankid'].".php?status=upgraded");
    }else{
        rankchange($conn, "user");
        header("location: ../../userinfo".$_SESSION['rankid'].".php?status=downgraded");
    }
}else{
    header("location: ../../userinfo".$_SESSION['rankid'].".php?err=notClicked");
}