<html>
<style>
body
{
	background: #E0E0E0; 
}
table {
	width:700px;
  height:70px;
  border-collapse: separate;
  border-spacing: 0;
  color: #4a4a4d;
  font: 14px/1.4 "Helvetica Neue", Helvetica, Arial, sans-serif;
	position: absolute;
	top: +100px;
	left: +350px;
	right: +560px;
	bottom: +40px;
}
th,
td {
  padding: 10px 15px;
  vertical-align: middle;
}
thead {
  background: #395870;
  background: linear-gradient(#49708f, #293f50);
  color: #fff;
  font-size: 11px;
  text-transform: uppercase;
}
th:first-child {
  border-top-left-radius: 5px;
  text-align: left;
}
th:last-child {
  border-top-right-radius: 5px;
}
tbody tr:nth-child(even) {
  background: #f0f0f2;
}
td {
  border-bottom: 1px solid #cecfd5;
  border-right: 1px solid #cecfd5;
}
td:first-child {
  border-left: 1px solid #cecfd5;
}
.book-title {
  color: #395870;
  display: block;
}
.text-offset {
  color: #7c7c80;
  font-size: 12px;
}
.item-stock,
.item-qty {
  text-align: center;
}
.item-price {
  text-align: right;
}
.item-multiple {
  display: block;
}
tfoot {
  text-align: right;
}
tfoot tr:last-child {
  background: #f0f0f2;
  color: #395870;
  font-weight: bold;
}
tfoot tr:last-child td:first-child {
  border-bottom-left-radius: 5px;
}
tfoot tr:last-child td:last-child {
  border-bottom-right-radius: 5px;
}
h1 { color: #7c795d; text-align: center; font-family: 'Trocchi', serif; font-size: 45px; font-weight: normal; line-height: 48px; margin: 0; }

#logout
{
display:block;
outline:0;
  width:200px;
  height:50px;
  background: #395870;
  background: linear-gradient(#49708f, #293f50);
  color:#fff;
  position:absolute;
  border-radius:10px;
  right:0;
  font-family:'Nunito','Arial';
  font-size:25px;
  margin-top:15px;
  border:linear-gradient(#49708f, #293f50);
  border-width:1px 1px 5px 1px;
  line-height:50px;
  text-align:center;
top:10px;
}
#reset
{
display:block;
outline:0;
  width:200px;
  height:50px;
  background: #395870;
  background: linear-gradient(#49708f, #293f50);
  color:#fff;
  position:absolute;
  border-radius:10px;
  right:0;
  font-family:'Nunito','Arial';
  font-size:25px;
  margin-top:15px;
  border:linear-gradient(#49708f, #293f50);
  border-width:1px 1px 5px 1px;
  line-height:50px;
  text-align:center;
left:10px;
top:10px;
}
</html>
</style>
<?php
 session_start();
  //if no session has been created redirect to login page;
  if(!isset($_SESSION['sessionid']))
  {
  //echo '<div style="color:#fff">'.$_SESSION['sessionkey'].'</div>';
  header('Location: login.php');
  }
$db= new mysqli('localhost','root','password123','mysql');
$sql="select * from result";
$result=$db->query($sql);
echo  '<h1>Results</h1> <a href="adminout.php" id="logout">Logout</a> <a href="resetflag.php" id="reset">Reset Flag</a>';
echo display($result);
$db->close();
function display($result)
{
	$r='';
	$r.='<table>';
	$r.= '<thead>
    <tr>
      <th scope="col">Roll no</th>
	  <th scope="col">Answer 1</th>
      <th scope="col">Answer 2</th>
      <th scope="col">Answer 3</th>
      <th scope="col">Answer 4</th>
      <th scope="col">Answer 5</th>

      <th scope="col">Marks</th>
    </tr>
  </thead>';
	while($row=$result->fetch_object())
	{
		$r.='<tr>';
		$r.='<td class="item-stock">'.htmlspecialchars($row->roll_no).'</td>';
		$r.='<td class="item-stock">'.htmlspecialchars($row->ans1).'</td>';
		$r.='<td class="item-stock">'.htmlspecialchars($row->ans2).'</td>';
		$r.='<td class="item-stock">'.htmlspecialchars($row->ans3).'</td>';
		$r.='<td class="item-stock">'.htmlspecialchars($row->ans4).'</td>';
		$r.='<td class="item-stock">'.htmlspecialchars($row->ans5).'</td>';
		$r.='<td class="item-stock">'.htmlspecialchars($row->marks).'</td>';
		$r.='</tr>';
	}
	$r.='</table>';
	return $r;
}
?>