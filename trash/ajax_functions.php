<?php
$path='';
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";
include $path."class/resize-class.php";



// if (isset($_REQUEST['addfriends']))
 //{
	// if($_REQUEST['addfriends']=='addfriends')
	 {
  $friendID =$_REQUEST['friendID'];
  $userID =$_REQUEST['userID'];

  $sql="INSERT INTO tsn_rel (userID, friendID, status) VALUES ('".$userID."','".$friendID."','1')";

 mysql_query($sql);
	// }
//}

?>