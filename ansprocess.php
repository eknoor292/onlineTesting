<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "password123";
if(isset($_SESSION['currentLevel']))
$currentLevel = $_SESSION['currentLevel'];
$ans = $_POST['ans'];
$_SESSION['level'.$currentLevel.'UserAns']=$ans;
//add the user ans


//if the ans is correct
if($ans==$_SESSION['level'.$_SESSION['currentLevel'].'AsliAns'])
{
echo '<div>Ans is correct</div>';
//increase the marks only when previous marks were zero
if($_SESSION['marks'.$_SESSION['currentLevel']]==0)
{
$_SESSION['marks'.$_SESSION['currentLevel']]+=$_SESSION['currentLevel'];
$_SESSION['totalMarks']+=$_SESSION['currentLevel'];
//update the marks and ans in database
$connection = mysqli_connect($servername, $username, $password);
if (!$connection) {
echo '<div>Error1</div>';
    die("Connection failed: " . mysqli_connect_error());
}
$db=mysqli_select_db($connection,"mysql");
if(!$db)
echo '<div>'.mysqli_error($connection).'</div>';
$sqlQuery = "UPDATE result SET marks=".$_SESSION['totalMarks'].",ans".$_SESSION['currentLevel']."='".$ans."' WHERE roll_no=".$_SESSION['sessionid'];
echo '<div>'.$sqlQuery.'</div>';
if(!mysqli_query($connection,$sqlQuery))
{
echo '<div>'.$sqlQuery.'</div>';
exit();
}
mysqli_close($connection);
}


}
else
{
echo '<div>Ans is False</div>';


if($_SESSION['marks'.$_SESSION['currentLevel']] == 0)
{

//update the marks decreased marks:(
}
else
{
//decrease the marks only when previous ans was correct
$_SESSION['marks'.$_SESSION['currentLevel']]=0;
$_SESSION['totalMarks']-=$_SESSION['currentLevel'];
}
//update the wrong ans :(
$connection = mysqli_connect($servername, $username, $password);
if (!$connection) {
echo '<div>Error1</div>';
    die("Connection failed: " . mysqli_connect_error());
}
$db=mysqli_select_db($connection,"mysql");
if(!$db)
echo '<div>'.mysqli_error($connection).'</div>';
$sqlQuery = "UPDATE result SET marks=".$_SESSION['totalMarks'].",ans".$_SESSION['currentLevel']."='".$ans."' WHERE roll_no=".$_SESSION['sessionid'];
if(!mysqli_query($connection,$sqlQuery))
{
echo '<div>'.$sqlQuery.'</div>';
exit();
}
echo '<div>'.$sqlQuery.'</div>';
mysqli_close($connection);
}
header('Location: q'.$currentLevel.'.php');
?>