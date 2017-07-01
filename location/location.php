<?
$path='../';
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

	$user_id=$_REQUEST['user_id'];
  $lon=$_REQUEST['lon'];
  $lat=$_REQUEST['lat'];
mysql_query("UPDATE  tsn_users SET  lat='$lat',lon='$lon' WHERE user_id ='$user_id'");



?> 