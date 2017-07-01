  <?php

//$post_id value comes from the POSTS table
$post_id=$prod['p_id'];?>



  <ol  id="update<?=$post_id ?>" class="timeline">
    
<?
			$qry_all_prod=$qry->querySelect("select *from  tsn_comments where post_id='".$post_id."' and post_type='".$post_type."' order BY `c_id` asc");
			foreach($qry_all_prod as $comment)
			{

$query = "select * from  tsn_users where user_id='".$comment['user_id']."'";
					$user_data = $qry->querySelectSingle($query);
?>
    
    
<div style="display:inline-block; border-bottom:#CCC solid 1px; width:100%; margin-bottom:5px; font-size:70%;">
  					
                    
                    <img src="photo_uploads/thumbs/<?=$user_data['profile_image'] ?>" style="width:50px; float:left; margin-right:10px;" class="thumbnail"><b><a href="<?=baseURL ?>u_<?=$user_data['user_name'] ?>"><?=$user_data['full_name'] ?></a></b>
                    <div> <?=$comment['comments'] ?></div>
                    <div style="margin-top:5px; color:#666;"><?
                              
							  echo time_passed(strtotime($comment['date_created']));?></div>
                   </div>

<?php
}
?>

</ol>
<div id="flash" align="left"  ></div>

<div>
<form name="cForm" id="cForm" action="#" method="post">
  <input name="user_id" type="hidden" id="user_id" value="<?=$user_id ?>">
   <input name="post_id" type="hidden" id="post_id" value="<?=$post_id ?>">
   <input name="post_type" type="hidden" id="post_type" value="<?=$post_type ?>">
  <textarea name="comment" rows="1" class="form-control"  placeholder="Write a comment..." id="comment<?=$post_id ?>"></textarea><br />

<input type="submit" class="submit btn btn-default" value=" Comment " />
</form>
</div>






</div>

