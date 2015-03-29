<?php
 session_start();
  //if no session has been created redirect to login page;
  ///*danerous*/$_SESSION['sessionid']='13104032';
  if(!isset($_SESSION['sessionid']))
  {
  //echo '<div style="color:#fff">'.$_SESSION['sessionkey'].'</div>';
  header('Location: login.php');
  }
  //generate the html;
  include 'header.php';
  $_SESSION['currentLevel']='5';
  
  $form='<body class="special">'.formGenerator();
  echo $form;
  
  function formGenerator()
  {
  $servername = "localhost";
$username = "root";
$password = "password123";
// Create connection
$connection = mysqli_connect($servername, $username, $password);

// Check connection
if (!$connection) {
	die("Connection failed: " . mysqli_connect_error());
	return 'Error in fetching the question';
	}
$query='select * from `mysql`.`result` where roll_no='.$_SESSION['sessionid'].''; 
//echo'<div>'.$query.'</div>';
$result=mysqli_query($connection,$query);
$row = mysqli_fetch_array($result);
$query1='select ans from `mysql`.`questions` where q_id='.$row[1].'';
//echo'<div>'.$query1.'</div>';
$result1=mysqli_query($connection,$query1);
$correctAnsRow=mysqli_fetch_array($result1);
$ans1=$correctAnsRow[0];
$query2='select ans from `mysql`.`questions` where q_id='.$row[3].'';
//echo'<div>'.$query2.'</div>';
$result2=mysqli_query($connection,$query2);
$correctAnsRow=mysqli_fetch_array($result2);
$ans2=$correctAnsRow[0];
$query3='select ans from `mysql`.`questions` where q_id='.$row[5].'';
//echo'<div>'.$query3.'</div>';
$result3=mysqli_query($connection,$query3);
$correctAnsRow=mysqli_fetch_array($result3);
$ans3=$correctAnsRow[0];
$query4='select ans from `mysql`.`questions` where q_id='.$row[7].'';
//echo'<div>'.$query4.'</div>';
$result4=mysqli_query($connection,$query4);
$correctAnsRow=mysqli_fetch_array($result4);
$ans4=$correctAnsRow[0];
$query5='select ans from `mysql`.`questions` where q_id='.$row[9].'';
//echo'<div>'.$query5.'</div>';
$result5=mysqli_query($connection,$query5);
$correctAnsRow=mysqli_fetch_array($result5);
$ans5=$correctAnsRow[0];
  
  
  $myForm='';
  $myForm.='
	
	<table class="result-table">
	<tr class="normal">
		<th>Question</th>
		<th>Your Answer</th>
		<th>Correct Answer</th>
	</tr>
		<tr class="normal">
			<td>1.
			</td>
			<td>'.$row[2].'
			</td>
			<td>'.$ans1.'
			</td>
		</tr>
		<tr class="normal">
			<td>2.
			</td>
			<td>'.$row[4].'
			</td>
			<td>'.$ans2.'
			</td>
		</tr>
	<tr class="normal">
	<td>3.
	</td>
	<td>'.$row[6].'
			</td>
	<td>'.$ans3.'
	</td>
	</tr>
	<tr class="normal">
	<td>4.
	</td>
	<td>'.$row[8].'
			</td>
	<td>'.$ans4.'
	</td>
	</tr>
	<tr class="normal">
	<td>5.
	</td>
	<td>'.$row[10].'
			</td>
	<td>'.$ans5.'
	</td>
	</tr>
	
	<tr>
	<td class="marks">Marks</td>
	<td class="marks">'.$row[11].'</td>
	<td>15</td>
	</tr>
	</table>';
	$myForm .='<form  method="post" class="myAnsForm" action="login.php">
	<br/>
	<br>
<button id="submit-ans">Ok</button>
	</form>';
	
  return $myForm;
  }
  
  
  
  session_destroy();
  
  ?>