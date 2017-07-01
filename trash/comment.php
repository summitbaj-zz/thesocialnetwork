



  <ol  id="update" class="timeline">
    
  <?php
$path='';
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";
//$post_id value comes from the POSTS table
$post_id=1;
			$qry_all_prod=$qry->querySelect("select *from  tsn_comments where post_id='".$post_id."' order BY `c_id` asc");
			foreach($qry_all_prod as $comment)
			{

$query = "select * from  tsn_users where user_id='".$comment['user_id']."'";
					$user_data = $qry->querySelectSingle($query);
?>
    
    
<div style="display:inline-block; border-bottom:#CCC solid 1px; width:100%; margin-bottom:5px; font-size:70%;">
  					
                    
                    <img src="photo_uploads/thumbs/<?=$user_data['profile_image'] ?>" style="width:50px; float:left; margin-right:10px;" class="thumbnail"><b><a href=""><?=$user_data['full_name'] ?></a></b>
                    
                    <div> <?=$comment['comments'] ?></div>
                    
                    <div style="margin-top:5px; color:#666;">25 minutes ago . <a href="#">LIKE</a></div>
                   </div>

<?php
}
?>

</ol>


<div id="flash" align="left"  ></div>

<div>
<form action="#" method="post"  role="form">

<textarea  class="form-control"  name="comment" id="comment"></textarea><br />

<input class="btn btn-default submit"  type="submit"value=" Comment " />
</form>
</div>


