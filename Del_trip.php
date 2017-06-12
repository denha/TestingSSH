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
include("universal_admin.php");

?>
<div style="margin-left:20px;margin-top:20px;">

<div style="margin-left:700px;margin-top:-5px;">

</div>
</div>

<form style="margin-left:240px" action="" method="POST">
<fieldset>
<legend>Delete Trip</legend>
<table cellspacing="18px"  border>

<?php
include("connection.php");
if(isset($_POST['Go'])){

$update=$_POST['Delete'];
$_SESSION['del']=$update;
$updateRoute="select * from trips where Trip_id='$update'";
$result=mysql_query($updateRoute);
while($row=mysql_fetch_array($result)){
	echo "<tr>";
echo "<td><input type=radio  name=trip  value=return> Return Trip </td><td><input type=radio name=trip value=one way checked  > One way Transfer </td></tr>";
echo "<tr><td>From<br><input type=text name='from' value='$row[point_of_depart]' style='padding:5px;width:160px;'/></td><td>To<br><input type=text name=to  value='$row[Destination]'style=padding:5px;width:160px;/></td></tr>";
echo "<tr><td>Depart Time & Date<br><input type=text name=Depart id=datepicker size=20 /><select name=DepartTime style=padding:5px;><option value=Morning>Morning</option><option value=AfterNoon>AfterNoon</option><option value=Evening>Evening</option></select></td><td>Arrival Time & Date<br><input type=text id=datepicker1 size=20 name=arrival/><select name=ArrivalTime style=padding:5px;><option value=Morning>Morning</option><option value=AfterNoon>AfterNoon</option><option value=Evening>Evening</option></select></td></tr>";	
	echo"<tr>";
echo"<td>Duration  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;seats&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Fare Px<br><input type=text value='$row[Duration]' name=duration style=padding:5px;width:80px; /><input type=text value='$row[Seats]' name=seats style=padding:5px;width:80px; /><input type=text value='$row[FarePx]' name=farepx style=padding:5px;width:80px /></td>";

echo "<td>";
echo "VechicleNo<br><input type=text name=regno value='$row[VehicleNO]'   style=padding:5px;width:160px;/>";
echo "</td>";
echo "</tr>";
	}
	echo "<tr>";
	echo "<td><input style=padding:5px;width:200px; type=submit name=submit value='Delete'/> </tr>";
	echo "</tr>";
echo"</table>";
echo"</fieldset>";

echo "</form>";
}
?>



</body>
</html>
<?php

if(isset($_POST['submit'])){
$del= $_SESSION['del'];
//echo "denis";
$dele="delete from trips where Trip_id='$del'";
$delchk="delete from chk where Trip_id='$del'";

$result2=mysql_query($delchk);
$result=mysql_query($dele);
if($result){
	$names="insert into notifications (PassengerName,Trip_id,Trip_Point_of_Arrival,Trip_Destination) select name,Trip_id,point_of_depart,Destination from Trips_temp inner join passenger_info where Trip_id='$del'  ";
	mysql_query($names);

echo "<script> alert('Route Cancelled')</script>";

}else{
	
	echo "Record not Deleted";
}	
}
	
?>


