  <?php
  session_start();
  //if no session has been created redirect to login page;
  if(!isset($_SESSION['sessionid']))
  {
  //echo '<div style="color:#fff">'.$_SESSION['sessionkey'].'</div>';
  header('Location: login.php');
  }
  //get time remaining;
  $currtime = time();
  $currtime = 1800-($currtime - $_SESSION['initTime']);
  $time = '<div id="currtime" style="display:none;">'.$currtime.'</div>';
  echo $time;
  //generate the html;
  include 'header.php';
  $_SESSION['currentLevel']=2;
  $form='<body>'.formGenerator();
  echo $form;
  echo '<script>
var seconds = parseInt(document.getElementById("currtime").innerHTML);
function secondPassed() {
    var minutes = Math.floor(seconds/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;  
    }
    document.getElementById("countdown").innerHTML = minutes + ":" + remainingSeconds;
    if (seconds <= 0) {
        clearInterval(countdownTimer);
        document.getElementById("countdown").innerHTML = "Time Over";
		window.location="lockans.php";
    } else {
        seconds--;
    }
}
 
var countdownTimer = setInterval("secondPassed()", 1000);
</script>';
  echo '</body></html>';
  function formGenerator()
  {
	//get user answers
	$level1UserAns='-';
$level2UserAns='-';
$level3UserAns='-';
$level4UserAns='-';
$level5UserAns='-';
if(isset($_SESSION['level1UserAns']))
$level1UserAns=$_SESSION['level1UserAns'];
if(isset($_SESSION['level2UserAns']))
$level2UserAns=$_SESSION['level2UserAns'];
if(isset($_SESSION['level3UserAns']))
$level3UserAns=$_SESSION['level3UserAns'];
if(isset($_SESSION['level4UserAns']))
$level4UserAns=$_SESSION['level4UserAns'];
if(isset($_SESSION['level5UserAns']))
$level5UserAns=$_SESSION['level5UserAns'];
	$myForm='';
	$question=questionGenerator();
	$question=htmlspecialchars($question);
	$question=nl2br($question);
	$myForm.='<div id="countdown"></div>';
	$myForm.='<div style="background-color: rgba(26, 180, 85, 0.9);height:67%;margin-left:-20px;width:200px;border-radius:15px;margin-top:85px;" >
<br/>
<div style="width:170px;padding-left:0px;" ><h2 id="sub-heading">SUBMISSIONS</h2></div><hr/>
<a href="q1.php" style="float:left;" class="qlink"><div id="levels" style="width:100px;padding-left:30px;padding-top:0px;padding-bottom:0px;" class="slider"><h3>Level 1</h3></div></a><span id="values" style="float:left;margin-top:20px;">'.$level1UserAns.'</span>
<a href="q2.php" style="float:left;" class="qlink"><div id="levels" style="width:100px;padding-left:30px;padding-top:0px;padding-bottom:0px;" class="slider"><h3>Level 2</h3></div></a><span id="values" style="float:left;margin-top:20px;">'.$level2UserAns.'</span>
<a href="q3.php" style="float:left;" class="qlink" ><div id="levels" style="width:100px;padding-left:30px;padding-top:0px;padding-bottom:0px;" class="slider"><h3>Level 3</h3></div></a><span id="values" style="float:left;margin-top:20px;">'.$level3UserAns.'</span>
<a href="q4.php" style="float:left;" class="qlink"><div id="levels" style="width:100px;padding-left:30px;padding-top:0px;padding-bottom:0px;" class="slider"><h3>Level 4</h3></div></a><span id="values" style="float:left;margin-top:20px;">'.$level4UserAns.'</span>
<a href="q5.php" style="float:left;" class="qlink"><div id="levels" style="width:100px;padding-left:30px;padding-top:0px;padding-bottom:0px;" class="slider"><h3>Level 5</h3></div></a><span id="values" style="float:left;margin-top:20px;">'.$level5UserAns.'</span>
</div>
	<div class="question-area"><pre>'.$question.'</pre></div>';
	$myForm .='<form  method="post" class="myAnsForm" action="ansprocess.php">
	<input type="text" id="ans" name="ans" value=""></input></br>
	<a href="q1.php" id="nextques">Previous</a>
	<button id="submit-ans">Submit</button>
	<a href="q3.php" id="nextques">Next</a>
	</form>
	<a href="lockans.php" id="lockans">Lock Answers and Logout</a>';
  return $myForm;
  }
  
  function questionGenerator()
  {
  //unset($_SESSION['level2id']);
  //if the question is already selected
	if(!isset($_SESSION['level2id']))
	{
		//then fetch a new question and set the question id
		//$qid = $_SESSION['level2id'];
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
			else
			{
				$_SESSION['marks'.$_SESSION['currentLevel']]=0;
				$query = 'SELECT min(q_id) FROM `mysql`.`questions` WHERE level='.$_SESSION['currentLevel']. ' and flag=0';
				//echo'<div>'.$query.'</div>';
				$result=mysqli_query($connection, $query);
				$row = mysqli_fetch_array($result);
				$_SESSION['level2id']=$row['min(q_id)'];
				$q_id = $row['min(q_id)'];
				$query='update `mysql`.`questions` set flag=1 where q_id='.$q_id;
				//echo'<div>'.$query.'</div>';
				$result=mysqli_query($connection, $query);
				$query='update `mysql`.`result` set q_id'.$_SESSION['currentLevel'].'='.$q_id. ' where roll_no='.$_SESSION['sessionid'];
				$result=mysqli_query($connection, $query);
				$query='SELECT ans FROM `mysql`.`questions` WHERE q_id='.$q_id;
				//echo'<div>'.$query.'</div>';
				$result=mysqli_query($connection, $query);
				$row = mysqli_fetch_array($result);
				$_SESSION['level'.$_SESSION['currentLevel'].'AsliAns'] = $row['ans'];
				//echo'<div>'.$_SESSION['level'.$_SESSION['currentLevel'].'AsliAns'].'</div>';
				$query='SELECT statement FROM `mysql`.`questions` WHERE q_id='.$q_id;
				//echo'<div>'.$query.'</div>';
				$result=mysqli_query($connection, $query);
				$row = mysqli_fetch_array($result);
				$statement = $row['statement'];
				mysqli_close($connection);
				return ($statement);
			}
	}
  //else fetch the old question
  else
  {
  $qid = $_SESSION['level2id'];
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
		else
		{
		$q_id=$_SESSION['level2id'];
		$query='SELECT statement FROM `mysql`.`questions` WHERE q_id='.$q_id;
		$result=mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result);
		$statement = $row['statement'];
		mysqli_close($connection);
		return ($statement);
		}
  }
  
  }
  
  ?>