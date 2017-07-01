

<!-- Modal -->
<div class="modal fade" id="myNotify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Notifications</h4>
      </div>
      <div class="modal-body">
       <!-- BODY -->
       <ul class="media-list">
       <?	$notify_number=0;
			$qry_all_prod=$qry->querySelect("select *from   tsn_notification where to_id='$user_id' order BY `not_id` desc"); ?><?
			foreach($qry_all_prod as $prod)
			{
				$query = "select * from  tsn_users where user_id='".$prod['from_id']."'";
					$post_data = $qry->querySelectSingle($query);
					
					$query = "select * from  tsn_posts where p_id='".$prod['p_id']."'";
					$to_data = $qry->querySelectSingle($query);
				?>
  <li  onclick="window.location.href='<?
  if($prod['type_id']<=3)
  echo baseURL."post_".$prod['p_id']; ?>'" 
  style="cursor:crosshair; background-color:<? if($prod['status']==1){ ?>#F4F4F4<? }else{?>#DDD<? }?>; padding:2px;"
  onmouseover="this.style.background='#D8EBF5';" 
  onmouseout="this.style.background='<? if($prod['status']==1){ ?>#F4F4F4<? }else{?>#DDD<? }?>';"
  class="media">
    <a class="pull-left" href="#">
       <img src="photo_uploads/thumbs/<?=$post_data['profile_image'] ?>" width="64">
    </a>
    <div class="media-body">
     <b><?=$post_data['full_name']?></b>
      <? 
	  switch($prod['type_id'])
	  {
		  case 1:
		  echo "has posted on your wall.";
		  break;
		  
		  case 2:
		  echo "has commented on your post.";
		  break;
		  case 3:
		  echo "has liked your post.";
		  break;
		  
		  case 4:
		  echo "has commented your photo.";
	      break;
		 case 5:
		  echo "has liked your photo.";
		  break;
		  }		
	  
	  ?>
      <div style="color:#999; font-size:80%;"><?=time_passed(strtotime($prod['date']))?></div>
    </div>
  </li><? if($prod['status']==0){
	  $notify_number++;}
	 } ?>
</ul>
<? if($notify_number==0){ ?>
<div style="font-size:20px; color:#999;">No New Notification</div><? } ?>
       <!-- BODY-->
      </div>
      <div class="modal-footer">
        <button type="button"  id="<?=$user_id ?>" class="notifySave btn btn-default" data-dismiss="modal">Close</button>
   
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
// Set up the buttons
$('.notifySave').on('click', function () {
   //Get the ID of the button that was clicked on
   var id_of_item_to_approve = $(this).attr("id");


   $.ajax({
      url: "ajax/ajax-notify.php", //This is the page where you will handle your SQL insert
      type: "post",
      data: "id=" + id_of_item_to_approve, //The data your sending to some-page.php
      success: function(){
          
      },
      error:function(){
          console.log("AJAX request was a failure");
      }   
    });
   $(this).button('loading');
    $(".notifySpan").hide();

});
</script>