<?php
session_start();
if(!isset($_SESSION['sessionid']))
header('Location: login.php');
header('Location: result.php');
?>