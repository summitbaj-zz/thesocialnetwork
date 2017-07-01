<?php
session_start();
include "class/db_connect.class.php";
include "class/sqlQuery.class.php";


/*********************************************************************
* This script has been released with the aim that it will be useful.
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
* All Copy Rights Reserved by Vasplus Programming Blog
***********************************************************************/


//Validate the request brought
if(isset($_POST["page"]) && !empty($_POST["page"]))
{
	$full_name = trim(strip_tags($_POST["fullnames"]));
	$user_name = trim(strip_tags(strtolower($_POST["usernames"])));
	$email_address = trim(strip_tags($_POST['emails']));
	$password = trim(strip_tags($_POST['passs']));
	$encrypted_password = md5($password);
	$f_sql = mysql_query("SELECT COUNT(*) FROM    tsn_users WHERE email_address='$email_address'");
	$email_count = mysql_result($f_sql, 0); 
	$f_sql = mysql_query("SELECT COUNT(*) FROM    tsn_users WHERE user_name='$user_name'");
	$user_count = mysql_result($f_sql, 0); 
	if($email_count>0)
	{
		echo "<div class='info'>Sorry, Email address already registered. Thanks.</div>";
	}
	elseif($user_count>0)
	{
		echo "<div class='info'>Sorry, Username already registered. Thanks.</div>";
	}elseif($full_name == "" || $user_name == "" || $email_address == "" || $password == "") //Be sure that all the fields are filled then proceed
	{
		echo "<div class='info'>Sorry, you have to fill in all the fields to proceed. Thanks.</div>";
	}
	else if(strlen($user_name) < 5)
	{
		echo "<div class='info'>Sorry, your username must not be less than 5 characters in length please. Thanks.</div>";
	}
	else if(preg_match('[^A-Za-z0-9]', $user_name))  //Be sure that username is properly formatted then proceed
	{
		echo "<div class='info'>Sorry, <font color='blue'>".$user_name."</font> is not in the proper format for a username. <br>Username should only contain letters and numbers.<br>Example formats: <font color='blue'>comfort</font>, <font color='blue'>victor18</font>, <font color='blue'>chuks29</font>, <font color='blue'>lemdy</font>, <font color='blue'>joyce</font>, <font color='blue'>prisca</font>, <font color='blue'>ibrahim</font>, <font color='blue'>Ahmad</font> etc</div>";
	}
	else
	{
		$unique_id=generateRandomString();
		$results=$qry->queryExecute("insert into tsn_users(full_name,user_name,email_address,password,unique_id) values('$full_name','$user_name','$email_address','$encrypted_password','$unique_id')");
		
		$query = "select * from  tsn_users where email_address='$email_address' and password='$encrypted_password' order by `user_id` desc";
				$post_data = $qry->querySelectSingle($query);
				
				$qry->queryInsert("INSERT INTO  tsn_posts(`user_id` ,`post`,`album_title`,`type_id`,`to_id`,`publish`)
												  VALUES ('".$post_data['user_id']."','','Profile Pictures','2','".$post_data['user_id']."','1') ");
				
				
		$_SESSION['user_name']=$user_name;
		$_SESSION['unique_id']=$unique_id;
		$_SESSION['reg_id']=1;
		phpredirect("index.php?p=login_uploadpic");
		
		?>
       <br clear="all"><br clear="all"><div class="vpb_main_wrapper" style="width:380px;"><br clear="all">
       <div class="info" style="width:340px;float:left;">You have registered successfully and below are your registration information!</div><br clear="all"><br clear="all">
       

        <div style="width:100px;float:left;" align="left">Fullname:</div>
        <div style="width:230px;float:left;" align="left"><?php echo $full_name; ?></div><br clear="all"><br clear="all">
        
        
        <div style="width:100px;float:left;" align="left">Username:</div>
        <div style="width:230px;float:left;" align="left"><?php echo $user_name; ?></div><br clear="all"><br clear="all">
        
        
        <div style="width:100px;float:left;" align="left">Email Address:</div>
        <div style="width:230px;float:left;" align="left"><?php echo $email_address; ?></div><br clear="all"><br clear="all">
        
        
      <!--     <div style="width:100px;float:left;" align="left">Password:</div>
      <div style="width:230px;float:left;" align="left"><?php echo $password; ?></div><br clear="all"><br clear="all">-->
        
        <div style="width:100px;float:left;" align="left">MD5 Password:</div>
        <div style="width:230px;float:left;" align="left"><?php echo $encrypted_password; ?></div><br clear="all"><br clear="all">
        
        
        <br clear="all">
        
        </div><br clear="all">
        <?php
	}
}
else
{
	echo "<div class='info'>Sorry, the operation was unsuccessful.<br>Please try again or contact this website admin to report this error message if the problem persist. Thanks.</div>";
}
?>