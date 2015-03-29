<?php
$db= new mysqli('localhost','root','password123','mysql');
$sql="update questions set flag=0 where flag=1";
$result=$db->query($sql);
$db->close();
header('Location: admin.php');
?>