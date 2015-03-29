<?php
session_start();
$pName = $_POST['name'];
$pEmail =$_POST['emailid'];
$pPassword=$_POST['password'];
if(strlen($pName)<=0||strlen($pEmail)<=0||strlen($pPassword)<=0)
$_SESSION['status']='failed';
else
$_SESSION['status']='success';

$_SESSION['previousNameValue']=$pName;
$_SESSION['previousEmailValue']=$pEmail;
$_SESSION['previousPasswordValue']=$pPassword;
header('Location: index.php');
?>