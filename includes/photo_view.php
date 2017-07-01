  <div class="panel-heading"><b><? echo $post_data['album_title'];
				?></b></div>
				<? 
$query = "select * from tsn_uploads where upload_id='".$_REQUEST['upload']."'";
				$img = $qry->querySelectSingle($query);

?> <?php

$query = "select * from tsn_uploads where upload_id=(select min(upload_id) from tsn_uploads where upload_id > ".$_REQUEST['upload'].") AND p_id=".$img['p_id'];
				$next = $qry->querySelectSingle($query);
				if($next['upload_id']=="")
				{
					$query = "select * from tsn_uploads where upload_id=(select min(upload_id) from tsn_uploads where upload_id < ".$_REQUEST['upload']." AND p_id=".$img['p_id'].")";
					$next = $qry->querySelectSingle($query);
		
				}

				
			
?>
   <div class="thumbnail"> <a href="<?=baseURL ?>imageID_<?=$next['upload_id']?>"><img src="photo_uploads/<?=$img['image_name'] ?>" title="<? echo $post_data['album_title']?>"></a>
      
    
      

</div><div class="panel-footer">
		<div class="row">
       		 <div class="col-md-8">
            
			<?  
			$post_type=2;
			$prod['p_id']=$_REQUEST['upload'];
		
				
				 include "like.php"; 
			include"comments.php"; ?>
              <div class="col-md-4">
         <div align="right">
			<a href="<?=baseURL?>?p=photo_upload&del=<?=$img['upload_id'] ?>">Delete This Photo</a><br />
            </div>
            </div>
            
            </div>
       
</div>