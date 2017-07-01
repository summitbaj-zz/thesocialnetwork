<?php session_start();
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//Connect to database from here
$path='../';
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";
//select the database | Change the name of database from here


//get the posted values
$user_name=htmlspecialchars($_POST['user_name'],ENT_QUOTES);
$pass=md5($_POST['password']);

//now validating the username and password
$sql="SELECT user_name, password FROM  tsn_users WHERE user_name='".$user_name."'";


$result=mysql_query($sql);
$row=mysql_fetch_array($result);

//if username exists
if(mysql_num_rows($result)>0)
{
	//compare the password
	if(strcmp($row['password'],$pass)==0)
	{
		echo "yes";
		
		//now set the session from here if needed
		
		$_SESSION['user_name']=$user_name; 
		$query = "select * from  tsn_users where user_name='".$user_name."'";
		$data = $qry->querySelectSingle($query);
		$_SESSION['unique_id']=$data['unique_id'];
	}
	else
		echo "no"; 
}
else
	echo "no"; //Invalid Login


?>