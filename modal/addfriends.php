<!-- Modal --><div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Friend Requests</h4>
      </div>
      <div class="modal-body">
      
      
      <ul class="media-list list-group ">



		<?
        
		$friend_request=0;
			$qry_all_prod=$qry->querySelect("select *from  tsn_rel where friendID='".$user_id."' and status = 0 order BY `rel_ID` desc");
			foreach($qry_all_prod as $rel)
			{
				
				$query = "select * from  tsn_users where user_id='".$rel['userID']."'";
					$post_data = $qry->querySelectSingle($query);
				
				?>
				  <li class="media list-group-item ">
    <a class="pull-left" href="#">
      <img width="40" class="media-object" src="photo_uploads/thumbs/<?=$post_data['profile_image'] ?>">
    </a>
    <div class="media-body">
      <h4 class="media-heading"><?=$post_data['full_name'] ?> <button id="<?=$rel['rel_ID']?>" type="button" data-loading-text="Request Accepted"  class="approve-button addbtn btn btn-primary pull-right">Accept Request</button></h4>
     
    </div>
  </li></ul>
                
                <? $friend_request++;
				
				} ?>
				



<script>
// Set up the buttons
$('.addbtn').on('click', function () {
   //Get the ID of the button that was clicked on
   var id_of_item_to_approve = $(this).attr("id");


   $.ajax({
      url: "ajax/ajax-addfriends.php", //This is the page where you will handle your SQL insert
      type: "post",
      data: "id=" + id_of_item_to_approve, //The data your sending to some-page.php
      success: function(){
          
      },
      error:function(){
          console.log("AJAX request was a failure");
      }   
    });
   $(this).button('loading');
   
   if((Number($(".friendSpan").text()) - 1) == 0)
   {
	   $(".friendSpan").hide();
   }else{
   $(".friendSpan").text( Number($("#friendSpan").text()) - 1 );
   }
});
</script><? if($friend_request==0){?>
                <div align="center" style=" font-size:24px; color:#CCC;">No Friend Requests</div>
                <? }?>
				
                
                      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->