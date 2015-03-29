<?php
session_start();
if(!isset($_POST['emailid'])||!isset($_POST['password']))
{
$_SESSION['loginStatus']='failed';
header('Location: login.php');
}
$rollno =$_POST['emailid'];
$pass=$_POST['password'];
$servername = "localhost";
$username = "root";
$password = "password123";
//try

if($rollno=='admin'&&$pass=='admin')
{
		//echo 'hi';
	$_SESSION['sessionid']=$rollno;
	header('Location: admin.php');
}
else
{
// echo'<div style="font-size:20px;">'.$rollno.'</div>';
// echo'<div style="ont-size:20px;">'.$pass.'</div>';
// Create connection
$connection = mysqli_connect($servername, $username, $password);

// Check connection
if (!$connection) {
echo '<div>Error1</div>';
    die("Connection failed: " . mysqli_connect_error());
}
$db=mysqli_select_db($connection);
if(!$db)
echo '<div>'.mysqli_error($connection).'</div>';
$sqlQuery = "SELECT * FROM `mysql`.`result` WHERE roll_no = ".$rollno;
$isAlreadyExisting=mysqli_query($connection, $sqlQuery);
$row =mysqli_fetch_array($isAlreadyExisting);
$rno = (string)$row['roll_no'];
//echo '<div>'.$sqlQuery.' '.$rno.'</div>';
if($rno==$rollno)
{
$_SESSION['found']=$row['roll_no'];
$_SESSION['sessionid']=$rollno;
mysqli_close($connection);
header('Location: result.php');
exit();
}

//echo '<div>'.$sqlQuery.' '.$isAlreadyExisting.'</div>';

$sqlQuery = "SELECT password FROM `mysql`.`userpassword` WHERE rollno = '".$rollno."'";
//echo '<div style="color:black;font-size:20px;border:1px solid red;">'.$sqlQuery.'</div>';;
$asliPassword = mysqli_query($connection, $sqlQuery);
if(!$asliPassword)
echo '<div>'.mysqli_error($connection).'</div>';
$row =mysqli_fetch_array($asliPassword,MYSQLI_ASSOC);
$zadaAsliPassword = $row['password'];
//echo '<div style="color:black;font-size:20px;border:1px solid red;width:50px;height:50px;">'.$zadaAsliPassword.'</div>';
if($pass==$zadaAsliPassword)
{
	$_SESSION['sessionid']=$rollno;
	$_SESSION['initTime']=time();
	$_SESSION['totalMarks']=0;
	$sqlQuery = "INSERT INTO `mysql`.`result`(`roll_no`, `q_id1`, `ans1`, `q_id2`, `ans2`, `q_id3`, `ans3`, `q_id4`, `ans4`, `q_id5`, `ans5`, `marks`) VALUES (".$rollno.",0,'',0,'',0,'',0,'',0,'',0)";
//echo '<div style="color:black;font-size:20px;border:1px solid red;">'.$sqlQuery.'</div>';;
$asliPassword = mysqli_query($connection, $sqlQuery);
	header('Location: q1.php');
	exit();
}
else
{
$_SESSION['loginStatus']='failed';
header('Location: login.php');
exit();
}

}

?>