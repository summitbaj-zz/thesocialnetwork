<?php
$path='../';
$the_profile=0;
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";
		$sender=$_REQUEST['sender'];
		$reciever=$_REQUEST['reciever'];

?>
<? 
				$results=$qry->queryExecute("update tsn_users set last_login='".date('Y-m-d H:i:s')."' where user_id='".$sender."'");
				
		$k=0;		$results=$qry->queryExecute("update message set status='1' where  sender=".$reciever."");
		$qry_all_prod=$qry->querySelect("SELECT * FROM message  where (reciever=".$reciever." and sender=".$sender.") or (reciever=".$sender." and sender='".$reciever."') ORDER BY id ASC");
			foreach($qry_all_prod as $row)
			{
				
				 $query = "select * from  tsn_users where user_id='".$row['sender']."'";
				 $post_data = $qry->querySelectSingle($query);
				 
				if($row['sender']==$sender)
				{
					$class=	"alert alert-info";
					$float='left';
					$pad='right';
				}
				else
				{
					$class=	"alert alert-warning";
					$float='right';
					$pad='left';
				}
  echo '<div class="media" style="margin:0px !important; padding:5px !important; "  > <a  style="margin-bottom:0px  !important;" class="pull-'.$float.' thumbnail" href="#">
    		 <img style="width:30px;" src="photo_uploads/thumbs/'.$post_data['profile_image'].'">
 		 </a>
  		  <div class="media-body"><div class="pull-'.$float.'  '.$class.'" style="margin:0px !important; width:auto; padding-'.$pad.':20px; padding-top:5px; padding-'.$float.':5px; display:inline-block;" align="'.$float.'" > '.'<b>'.$post_data['full_name'].'</b>'. '<br />' . $row['message'].'</div></div></div>';
  $k++;
  }
  	if($k==0)
	{?>
		<DIV style="font-size:18px; color:#ddd;" align="center">NO CHAT TO DISPLAY</DIV>
	<? }

?>
