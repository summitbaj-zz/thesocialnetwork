<?php
$path='../';
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";


if($_REQUEST)
{


  $friendID =$_REQUEST['id'];
  $userID =$_REQUEST['user_id'];

  $sql="INSERT INTO tsn_rel (userID, friendID, status) VALUES ('".$userID."','".$friendID."','0')";

 $qry->queryInsert($sql);

}

?>