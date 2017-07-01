<script type="text/javascript">

$(document).ready(function(){
   var j = jQuery.noConflict();
	j(document).ready(function()
	{
		j(".online").everyTime(1000,function(i){
			j.ajax({
			  url: "location/online.php",
			  data: "user_id=<?=$user_id ?>",
			  cache: false,
			  success: function(html){
				j(".online").html(html);
			  }
			})
		})
	});

});



</script>

<? if(isset($_REQUEST['user_name']))
{
	$query = "select * from  tsn_users where user_name='".$_REQUEST['user_name']."'";
	$profile = $qry->querySelectSingle($query);
	$profile_id=$profile['user_id'];
}

$f_sql = mysql_query('SELECT COUNT(*) FROM   tsn_rel WHERE (( userID = '.$user_id.' and friendID = '.$profile_id.') OR ( friendID = '.$user_id.' and userID = '.$profile_id.')) and status = 1 ');
		$fcount = mysql_result($f_sql, 0); 

		$pcount = mysql_result(mysql_query('SELECT COUNT(*) FROM   tsn_rel WHERE (( userID = '.$user_id.' and friendID = '.$profile_id.') OR ( friendID = '.$user_id.' and userID = '.$profile_id.')) and status = 0 '), 0); 




?>




<div class="col-md-4"> 





    <div class="thumbnail">
    
    <div class="media panel panel-info">
     
  <a class="pull-left" href="#">
     <img src="photo_uploads/thumbs/<?=$user['profile_image'] ?>">
  </a>
         		 <h3 style="font-weight:bold; margin-top:10px;" class="panel-title"><?=$user['full_name']?></h3>
      
  <div class="media-body">
    <a href="<?=baseURL ?>u_<?=$user['user_name'] ?>">Edit Profile</a></div>
</div>
     
      <div class="caption">
   
        
        <div class="panel panel-default">        
              <div class="panel-heading">
         		 <h3 class="panel-title">Users Online</h3>
      		  </div>
      		  <div class="panel-body">
              <div class="online">
              <!-- -->
              
            <? 
			$k=0;
			$profile_id=$user_id;
			$qry_all_prod=$qry->querySelect("select *from  tsn_rel where userID='$profile_id' OR friendID='$profile_id' order BY `rel_ID` desc");
			foreach($qry_all_prod as $friend_data)
			{  
					$theID=$friend_data['friendID'];
					if($theID==$profile_id)
					$theID=$friend_data['userID'];
			
					$query = "select * from  tsn_users where location=1 and user_id='".$theID."'";
					$post_data = $qry->querySelectSingle($query);
			if(time_diff(strtotime($post_data['last_login']))<5)
		{
					?>
			  <div class="media" style="border-bottom:#CCC solid 1px; width:100%; padding:2px; display:inline-block;">  <a href="wh_<?=$post_data['user_name'] ?>"><span class="pull-right" style="color:#090; font-weight:bold; font-size:70%;">LOCATE</span>
  <div  class="pull-left">
      <img src="photo_uploads/thumbs/<?=$post_data['profile_image']  ?>" style="margin-right:10px;" width="30"></div>
 

			<? echo $post_data['full_name'] ?>
            
            </a></div><? $k++; }
	} 
	
	
	if($k==0){?>
<div>No friends Available</div>
<? 
	}
?>    
              
              <!-- -->
              
              
   			  </div>
       		 </div>
    </div>
    
    
    
    
    
    
    
    </div>
 </div>
  


</div>

<div class="col-md-6">
<div class="panel">
<div class="panel-body">
<!-- Start of Tab -->
<h3><?=$profile['full_name']?></h3>


<? include "location/index.php"; ?>
</div>
</div>



<!-- End of tab-->
</div>




<div class="col-md-2">
  <a href="#" class="thumbnail">
      <img src="images/SNP_2922277_en_v0.png" alt="...">
    </a>
</div>

</div>
