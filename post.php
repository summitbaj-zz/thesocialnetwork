





 <?
 
 
 


	
	  		$count=1;
			$query="select *from   tsn_posts where p_id='".$_REQUEST['post_id']."' and to_id='$user_id' order BY `p_id` desc";
			$prod = $qry->querySelectSingle($query);
		
		?>  
        		
        		<? $query = "select * from  tsn_users where user_id='".$prod['user_id']."'";
					$post_data = $qry->querySelectSingle($query);
					
					$query = "select * from  tsn_users where user_id='".$prod['to_id']."'";
					$to_data = $qry->querySelectSingle($query);
					
				?>
      				
                    
     

       
					<div class="panel panel-default">
  					<img style="width:90px; margin:10px; float:left; display:inline-block;" 
                    src="photo_uploads/thumbs/<?=$post_data['profile_image'] ?>" class="thumbnail">	
                         <div class="panel-body">
                         <div>
                         <a href="<?=baseURL; ?>u_<?=$post_data['user_name'] ?>">
						 <?=$post_data['full_name'] ?>
                         </a>
						 <? if($prod['user_id']!=$prod['to_id'])
						    {?>
                         	 > <a href="<?=baseURL; ?>u_<?=$post_data['user_name'] ?>"><?=$to_data['full_name'] ?></a>
						<? } ?></div>
   						     
							 
							 <?=$prod['post'] ?>
                     
                              <div style="margin-top:5px; color:#666;"><?
							 
							 				  echo time_passed(strtotime($prod['date_created']));?></div>
                           </div>
   
    			<? if($prod['type_id']==2){?>	
               <div class="panel-body">
              <div class="panel-heading"><b><a href="albumID_<? echo $prod['p_id']?>"><?=$prod['album_title'] ?></a></b></div>
 	         <div class="row">
                               	<?	$qry_all_prod=$qry->querySelect("select *from   tsn_uploads where  	p_id=".$prod['p_id']." order BY `p_id` desc LIMIT 0,4");
			foreach($qry_all_prod as $mod)
			{
		?> 
        <div class="col-xs-6 col-md-3"> <a href="imageID_<?=$mod['upload_id'] ?>" class="thumbnail">
      <img src="photo_uploads/thumbs/<?=$mod['image_name'] ?>">
    </a>
  </div> 
        
        <? }
		?></div><? }?>
        
        
          		  <div class="panel-footer">
            	   
                <? 
				$post_type=1;
				 include "like.php"; ?>
                 
    <?  
	
	include"comments.php"; ?>
                
                
                   
          </div>