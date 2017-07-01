 
        
        
        <div class="panel-heading"><b><? echo $post_data['album_title'];
				?></b>  <? if($post_data['user_id']==$user_id){?>
                 <button  onclick="location.href='<?=baseURL ?>picuploadID=<?=$post_data['p_id'] ?>';" type="button" class="btn btn-default btn-xs pull-right">
  <span class="glyphicon glyphicon-picture"></span> Add Photos
</button><? } ?></div>
				
    <div class="panel-body">
    <? if(isset($_SESSION['deleted'])){?>    
        <div>
        Deleted successfully
        </div><? } unset($_SESSION['deleted']);
		
		?>
      <div class="row">

   	<?	$qry_all_prod=$qry->querySelect("select *from   tsn_uploads where  	p_id=".$_REQUEST['album']." order BY `upload_id` desc");
			foreach($qry_all_prod as $prod)
			{
		?>   <div class="col-xs-4 col-md-2"> <a href="imageID_<?=$prod['upload_id'] ?>" class="thumbnail">
      <img src="photo_uploads/thumbs/<?=$prod['image_name'] ?>">
    </a>
  </div> 
  <? }?>

</div>
</div>