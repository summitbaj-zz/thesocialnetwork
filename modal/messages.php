

<!-- Modal -->
<div class="modal fade" id="myMessages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Messages</h4>
      </div>
      <div class="modal-body">
       <!-- BODY -->
       <ul class="media-list">
       <?	$message_number=0;
			$qry_all_prod=$qry->querySelect("select *from   message where reciever ='$user_id' AND status=0  GROUP BY `sender` order BY `id` desc"); ?><?
			foreach($qry_all_prod as $prod)
			{
				$query = "select * from  tsn_users where user_id='".$prod['sender']."'";
					$post_data = $qry->querySelectSingle($query);
				
				?>
  <li  onclick="window.location.href='<?
  echo baseURL."c_".$post_data['user_name']; ?>'" 
  style="cursor:pointer; background-color:<? if($prod['status']==1){ ?>#F4F4F4<? }else{?>#DDD<? }?>; padding:2px;"
  onmouseover="this.style.background='#D8EBF5';" 
  onmouseout="this.style.background='<? if($prod['status']==1){ ?>#F4F4F4<? }else{?>#DDD<? }?>';"
  class="media">
    <a class="pull-left" href="#">
       <img src="photo_uploads/thumbs/<?=$post_data['profile_image'] ?>" width="64">
    </a>
    <div class="media-body">
     <b><?=$post_data['full_name']?></b>
   <div><? 
echo $prod['message']	
	  
	  ?>
      </div>
      <div style="color:#999; font-size:80%;"><?=time_passed(strtotime($prod['date']))?></div>
    </div>
  </li><? if($prod['status']==0){
	  $message_number++;}
	 } ?>
</ul><? if($message_number==0){ ?>
<div style="font-size:20px; color:#999;">NO NEW MESSAGES</div><? } ?>

       <!-- BODY-->
      </div>
      <div class="modal-footer">
        <button type="button"  id="<?=$user_id ?>" class="notifySave btn btn-default" data-dismiss="modal">Close</button>
   
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

