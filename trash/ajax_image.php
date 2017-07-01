<?php
$path='';
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";
session_start();
$session_id=$_SESSION['unique_id']; // Session_id
$t_width = 100;	// Maximum thumbnail width
$t_height = 100;	// Maximum thumbnail height
$new_name = "small".$session_id.".jpg"; // Thumbnail image name
$path = "uploads/";
if(isset($_GET['t']) and $_GET['t'] == "ajax")
	{
		extract($_GET);
		$ratio = ($t_width/$w); 
		$nw = ceil($w * $ratio);
		$nh = ceil($h * $ratio);
		$nimg = imagecreatetruecolor($nw,$nh);
		$im_src = imagecreatefromjpeg($path.$img);

		imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$nw,$nh,$w,$h);
		imagejpeg($nimg,$path.$new_name,180);
	//	mysql_query("UPDATE  tsn_users SET profile_image='$new_name' WHERE unique_id='$session_id'");
		echo $new_name."?".time();
		exit;
	}
	
	?>