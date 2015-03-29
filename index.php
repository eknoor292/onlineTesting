<?php
session_start();
include 'header.php';
echo '<body>'.formGenerator().'</body></html>';
//$l=$_SESSION['status'];
// if($l=='failed')
// echo '<div style="color:#fff;font-size:22px;">failed</div>';
// else if($l=='success')
// echo '<div style="color:#fff;font-size:22px;">success</div>';

function formGenerator()
{
$myForm = '';
$pName = nameValue();
$pEmail=emailValue();
$message=isSuccess();
$myForm.=$message;
$myForm .='<form  method="post" class="myForm" action="process.php">
    <h1>Sign Up Form</h1>
    
    <h2><span class="circle">-></span>     Your Info</h2>
    <label for="name">Name:</label></br>
    <input type="text" id="name" name="name" value="'.$pName.'"></input>
	</br></br>
    <label for="email">Roll no.:</label></br>
	<input type="text" id="email" name="emailid" value="'.$pEmail.'"></input>
	</br>
	</br>
	<label for="password">Password:</label></br>
    <input type="password" id="password" name="password"></input>
</br></br>
<button id="submit">Submit</button>';

return $myForm;
}
function nameValue()
{
$previousName='';
if(isset($_SESSION['status']))
{
	if($_SESSION['status']=='failed')
	{

	$previousName= $_SESSION['previousNameValue'];
	$_SESSION['previousNameValue']='';
	return $previousName;
	}
}
else
return '';
}
function emailValue()
{
$previousEmail='';
if(isset($_SESSION['status']))
{	
	if($_SESSION['status']==='failed')
	{
	$previousEmail= $_SESSION['previousEmailValue'];
	$_SESSION['previousNameValue']='';
	return $previousEmail;
	}
}
else
return '';
}
function isSuccess()
{
if(isset($_SESSION['previousNameValue']))
{
$user=$_SESSION['previousNameValue'];
$pass=$_SESSION['previousPasswordValue'];
$rollno=$_SESSION['previousEmailValue'];

}
//reset previous name and email variables always
if(isset($_SESSION['previousNameValue']))
{$_SESSION['previousNameValue']='';
$_SESSION['previousEmailValue']='';
}
if(isset($_SESSION['status']))
{
		if($_SESSION['status']=='success')//if successful submission
		{
			//then display success message;
			$r='';
			$r .= '<div class="signup-message">You have signed up successfully</div>';
			//reset all session variables;
			$_SESSION['status']='';
			//then connect-database and add values;
$servername = "localhost";
$username = "root";
$password = "password123";
// echo'<div style="color:#fff;font-size:20px;">'.$user.'</div>';
// echo'<div style="color:#fff;font-size:20px;">'.$pass.'</div>';
// Create connection
$connection = mysqli_connect($servername, $username, $password);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo '<div style="color:#fff;font-size:20px;">Connected successfully</div>';
$sql = "INSERT INTO `mysql`.`userpassword` (`username`, `password`, `rollno`) VALUES ('".$user."','". $pass."', '".$rollno."')";

//echo'<div style="color:#fff;font-size:20px;">'.$sql.'</div>';
if (mysqli_query($connection, $sql)) {
     // echo '<div style="color:#fff;font-size:20px;">Database created successfully</div>';
}
mysqli_close($connection);
			
			return $r;
}
		else if($_SESSION['status']=='failed')
		{
			$_SESSION['status']='';
			return '<div class="signup-message">Please enter the info correctly</div>';
		}
		
		else
		return '';
}

}
?>