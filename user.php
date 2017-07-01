<? 

$my_self=0;
if($profile_id==$user_id)
$my_self=1;

$f_sql = mysql_query('SELECT COUNT(*) FROM   tsn_rel WHERE (( userID = '.$user_id.' and friendID = '.$profile_id.') OR ( friendID = '.$user_id.' and userID = '.$profile_id.')) and status = 1 ');
		$fcount = mysql_result($f_sql, 0); 

		$pcount = mysql_result(mysql_query('SELECT COUNT(*) FROM   tsn_rel WHERE (( userID = '.$user_id.' and friendID = '.$profile_id.') OR ( friendID = '.$user_id.' and userID = '.$profile_id.')) and status = 0 '), 0); 

$mcount=$fcount;
if($my_self==1)
$mcount=1;


if (isset($_REQUEST['addfriends']))

{
  $friendID =$profile_id;
  $userID =$user_id;

  $sql="INSERT INTO tsn_rel (userID, friendID, status) VALUES ('".$userID."','".$friendID."','0')";

 $qry->queryInsert($sql);

 phpredirect(baseURL."u_".$profile['user_name']);
}

if (isset($_REQUEST['rfriends']))

{

  $sql='DELETE FROM tsn_rel  WHERE ( userID = '.$user_id.' and friendID = '.$profile_id.') OR ( friendID = '.$user_id.' and userID = '.$profile_id.') ';

 $qry->queryDelete($sql);

 phpredirect(baseURL."u_".$profile['user_name']);
}
?>




<div class="col-md-4"> 
    <div class="thumbnail">
    <? if($my_self==1){?><a href="<?=baseURL ?>?p=login_uploadpic"><? } ?>
    <img src="photo_uploads/medium_<?=$profile['profile_image']?> " width="100%">
    <? if($my_self==1){?></a><? } ?>
     <div class="caption">
   
        
   <? if($mcount>0){?><div class="panel panel-info">        
              <div class="panel-heading">
         		 <h3 class="panel-title">Information</h3>
      		  </div>
      		  <div class="panel-body">                            
                            
                            
                            
                            
                            
 							
				<div><b>Birthday</b></div>
 							<div><?=$user['birthday']?></div>
                            
                            <div><b>Current City</b></div>
 							<div><?=$user['current_city']?></div>    
					
							

               
  
        <br />
        
       
 
        
      </div>
    </div>
        <? } ?>
 		
    <? if($my_self==0){?>
    <p><? if($fcount>0){?><a href="<?=baseURL ?>u_<?=$profile['user_name']?>&rfriends"  class="btn btn-danger"  data-loading-text="Posting..." role="button">Unfriend</a><? }elseif($pcount>0){?><a href="#" class="btn btn-default disabled" role="button">Pending Request</a><? } else{ ?><button id="<?=$profile['user_id']?>" type="button" data-loading-text="Request Sent"  class="addasfren addbtn btn btn-primary pull-right">Add As Friend</button><? } ?> <a href="<?=baseURL ?>c_<?=$profile['user_name']?>" class="btn btn-default" role="button">Message</a></p>
    <? } ?>
    
    <script>
// Set up the buttons
$('.addasfren').on('click', function () {
   //Get the ID of the button that was clicked on
   var id_of_item_to_approve = $(this).attr("id");


   $.ajax({
      url: "ajax/ajax-sendrequest.php", //This is the page where you will handle your SQL insert
      type: "post",
      data: "id=" + id_of_item_to_approve+"&user_id=<?=$user_id ?>", //The data your sending to some-page.php
      success: function(){
          
      },
      error:function(){
          console.log("AJAX request was a failure");
      }   
    });
   $(this).button('loading');
   
  
});
</script>
    
    
    </div>
  <? if($mcount>0){?>
    <div class="caption">
    	       <div class="panel panel-info">        
              <div class="panel-heading">
         		 <h3 class="panel-title">Friends</h3>
      		  </div>
      		  <div class="panel-body"> <div class="row">
            <? 
			$qry_all_prod=$qry->querySelect("select *from  tsn_rel where (userID='$profile_id' OR friendID='$profile_id') and status='1' order BY `rel_ID` desc");
			foreach($qry_all_prod as $friend_data)
			{  
					$theID=$friend_data['friendID'];
					if($theID==$profile_id)
					$theID=$friend_data['userID'];
			
					$query = "select * from  tsn_users where user_id='".$theID."'";
					$post_data = $qry->querySelectSingle($query);?>
			  <div class="col-sm-4">
    <a href="<?=baseURL ?>u_<?=$post_data['user_name'] ?>" class="thumbnail">
      <img src="photo_uploads/thumbs/<?=$post_data['profile_image'] ?>" alt="...">
    </a>
  </div>
			
			<? }?></div>
              </div></div>
    </div>
    <? } ?>
 </div>
  




</div>

<div class="col-md-6">

<? 
if(isset($_REQUEST['editabout']))
include "includes/edit.php";
elseif(isset($_REQUEST['editwork']))
include "includes/edit.php";
else 
include "includes/tab.php"; ?>
</div>
<!-- End of tab-->



<div class="col-md-2">
  <a href="#" class="thumbnail">
      <img src="images/SNP_2922277_en_v0.png" alt="...">
    </a>
</div>

</div>
