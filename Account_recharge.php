<html>
<head>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  
  <script>
  $(document).ready(function() {
    $("#datepicker").datepicker();
  });
   $(document).ready(function() {
    $("#datepicker1").datepicker();
  });
  </script>
  <style>
  legend{
	  padding-right:60px;
  }
  </style>
</head>
<body>
<?php
include("universal.php");

?>
<div style="margin-left:20px;margin-top:20px;">

<div style="margin-left:700px;margin-top:-5px;">

</div>
</div>

<form style="margin-left:240px" action="" method="POST">
<fieldset>
<legend>Account Recharge</legend>
<table cellspacing="18px"  border>
<?php 
include("connection.php");
$string="select * from passenger_info where passenger_id='$_SESSION[id]'";
$result=mysql_query($string);
while($row=mysql_fetch_array($result)){

echo "<tr><td>Name</td><td><input type=text value='$row[name]' /></td></tr>";
echo "<tr><td>Email Address</td><td><input type=text value=$row[Email]  /></td></tr>";
echo"<tr>";
echo"<td>Phone</td><td><input type=text value='$row[phone_no]'</td></tr>";
echo"<tr>";
echo"<td>";

echo"Recharge Amount</td> <td><input type=text name=Amount  </td>";

echo"</tr>";
echo"<tr>";
echo"<td><input style=padding:5px;width:200px; type=submit name=send value='Submit' /> </tr>";
echo"tr>";
echo"</table>";
}
?>
</fieldset>

</form>
</body>
</html>
<?php
include("connection.php");
if(isset($_POST['send'])){
$amount=$_POST['Amount'];
$String="insert into accounts(passenger_id,AccountCr)values('$_SESSION[id]','$amount')";
$result=mysql_query($String);


if($result){
echo "<script> alert('Account Recharged')</script>";
	
}else
{
echo " not executed";	
}



}

?>
