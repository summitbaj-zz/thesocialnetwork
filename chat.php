<script type="text/javascript">

$(document).ready(function(){
   var j = jQuery.noConflict();
	j(document).ready(function()
	{
		j(".online").everyTime(1000,function(i){
			j.ajax({
			  url: "chat/online.php",
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

<? if($_REQUEST['user_name'])
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


<? include "chat/index.php"; ?>
</div>
</div>



<!-- End of tab-->
</div>




<div class="col-md-2">
  <a href="#" class="thumbnail">
      <img src="images/SNP_2922277_en_v0.png">
    </a>
</div>

</div>
