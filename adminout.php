<?php
session_start();
if(!isset($_SESSION['sessionid']))
header('Location: login.php');
session_destroy();
header('Location: login.php');
?>