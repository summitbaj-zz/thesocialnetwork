<?php 


$message='';
		$sender=$user_id;
		$reciever=$profile_id;
		
if(isset($_POST['submit']))
{
		

		$message=trim (addslashes($_POST['message']));
		

		mysql_query("INSERT INTO message(message, sender,reciever)VALUES('$message', '$sender','$reciever')");
}

?>



<script type="text/javascript">

$(document).ready(function(){
						   
   var j = jQuery.noConflict();
	j(document).ready(function()
	{
		j(".refresh").everyTime(1000,function(i){
			j.ajax({
			  url: "chat/refresh.php",
			  data: "sender=<?=$sender ?>&reciever=<?=$reciever ?>",
			  cache: false,
			  success: function(html){
				j(".refresh").html(html);
				j( "div.chat-area" ).scrollTop( 5000 );
			  }
			})
			
		})
		
	});
	
	j(document).ready(function() {
			j('#post_button').click(function() {
				$text = $('#post_text').val();
				j.ajax({
					type: "POST",
					cache: false,
					url: "save.php",
					data: "text="+$text,
					success: function(data) {
						alert('data has been stored to database');
					}
					
				});
				$( "div.chat-area" ).scrollTop( 5000 );
			});
		});
   j('.refresh').css({color:"green"});
});
</script>

<style type="text/css">
.chat-area .refresh {
	color: green;
	font-family: tahoma;
	font-size: 12px;
	padding:10px;
	background-color:#FFFFFF;
	bottom: 0px;
	display: inline-block;
	width: 100%;
}
#post_button{

	width: 100px;
	cursor:pointer;
}
#textb{
	
}
#texta{
	border: 1px solid #3366FF;
	border-left: 4px solid #3366FF;
	width: 410px;
	margin-bottom: 10px;
	padding:5px;
}

.chat-area {
	position: relative;
	height: 300px;
	width: 100%;
	overflow: auto;
}
</style>
<div class="panel panel-default">
  <div class="panel-body">
  <? 
  if($reciever!=$sender)
{ ?>
<form method="POST" class="form" name="" action="">
<input name="sender" type="hidden" id="texta" value="<?php echo $sender ?>"/>
<div class="form-group">
	  <div class="chat-area">
        <div class="refresh">
<?php

		$qry_all_prod=$qry->querySelect("SELECT * FROM message where (reciever=".$reciever." and sender=".$sender.") or (reciever=".$sender." and sender='".$reciever."') ORDER BY id ASC");
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
  }


?>

</div>
      </div>
</div>
</div>
<div class="panel-footer" style="display:inline-block; width:100%;">
<div class="form-group">
<input name="message" class=" form-control" type="text" id="textb"/>
</div>
<div class="form-group">
<input name="submit"  class=" form-control pull-right" type="submit" value="Chat" id="post_button" />
</div>
</form>
<? }else{?>
<DIV style="font-size:18px; color:#ddd;" align="center">NO CHAT TO DISPLAY</DIV>

<? } ?>
</div>
</div><script>
$( "div.chat-area" ).scrollTop( 5000 );
</script>