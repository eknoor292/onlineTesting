<?php
session_start();
if(isset($_SESSION['sessionid']))
header('Location:lockans.php');
include 'header.php';
echo '<body>'.formGenerator().'</body></html>';

function formGenerator()
{
$r='';
if(isset($_SESSION['loginStatus']))
{
	if($_SESSION['loginStatus']=='failed')
	{$r.='<div class="signup-message">Incorrect Username/Password</div>';
	$_SESSION['loginStatus']='';
	}
}


$r.='<form  method="post" class="myForm2" action="loginprocess.php">
    <h1>Login Form</h1>
    
    <h2><span class="circle">-></span>Enter Your Details</h2>
    <label for="email">Roll no.:</label></br>
	<input type="text" id="email" name="emailid" value=""></input>
	</br>
	</br>
	<label for="password">Password:</label></br>
    <input type="password" id="password" name="password"></input>
</br></br>
<button id="submit">Submit</button>';


return $r;
}

?>