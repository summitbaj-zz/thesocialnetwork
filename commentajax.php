<?php
$path='';
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";


if($_POST)
{

		$comments=trim (addslashes($_POST['comment']));
		$post_id=$_POST['post_id'];
		$user_id=$_POST['user_id'];
		$post_type=$_POST['post_type'];
		
		$qry->queryInsert("INSERT INTO  tsn_comments(`user_id` ,`comments`,`post_id`,`post_type`)
		VALUES ('$user_id','$comments','$post_id','$post_type') ");	
		
		if($post_type==1)
		{ 
		
			$type_id=2; 
			$query = "select * from tsn_posts where p_id='".$post_id."' order by `p_id` desc";
			$user_data = $qry->querySelectSingle($query);
			$to_id=$user_data['to_id'];
		
		}
		if($post_type==2)
		{ 
			$type_id=4;	 
			$query = "select * from tsn_uploads where upload_id='".$post_id."' order by `upload_id` desc";
			$user_data = $qry->querySelectSingle($query);
			$to_id=$user_data['user_id'];
		}
		

		
		
		
		if($to_id!=$user_id){
		//1. wallpost 2. Comment_post 3. Like
		$qry->queryInsert("INSERT INTO  tsn_notification(`p_id` ,`type_id`,`from_id`,`to_id`)
		VALUES ('".$post_id."','$type_id','$user_id','$to_id') ");
		
		}

}

else { }
$query = "select * from  tsn_users where user_id='".$user_id."'";
					$user_data = $qry->querySelectSingle($query);
?>
<div style="display:inline-block; border-bottom:#CCC solid 1px; width:100%; margin-bottom:5px; font-size:70%;">
  					
                    
                    <img src="photo_uploads/thumbs/<?=$user_data['profile_image'] ?>" style="width:50px; float:left; margin-right:10px;" class="thumbnail"><b><a href="u_<?=$user_data['user_name'] ?>"><?=$user_data['full_name'] ?></a></b>
                    <div> <?=$_POST['comment'] ?></div>
                    <div style="margin-top:5px; color:#666;">Just Now . <a href="#">LIKE</a></div>
                   </div>