
 <?php
session_start();
$path='../';
$the_profile=0;
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";
include $path."class/functions.php";

?>


<?

if(isset($_POST['lastmsg']))
{
$lastmsg=$_POST['lastmsg'];
 

	if($the_profile==1)
	{	$add_que=" where to_id=".$profile['user_id'];
	}
	else{
		$add_que="where to_id IN
		( select userID from  tsn_rel where (userID='$user_id' OR friendID='$user_id') AND status ='1')
		
		OR user_id IN
		( select friendID from  tsn_rel where (userID='$user_id' OR friendID='$user_id') AND status ='1')
		
		OR to_id='$user_id'";
		}
	
	  		$count=1;
			$msg_id=$lastmsg;
			$qry_all_prod=$qry->querySelect("select *from   tsn_posts $add_que order BY `p_id` desc LIMIT $lastmsg,10");
			foreach($qry_all_prod as $prod)
			{
						?>  
        		
        		<? $query = "select * from  tsn_users where user_id='".$prod['user_id']."'";
					$post_data = $qry->querySelectSingle($query);
					
					$query = "select * from  tsn_users where user_id='".$prod['to_id']."'";
					$to_data = $qry->querySelectSingle($query);
					
				?>
      				
                    
     

       
					<div class="panel panel-default">
  					<img style="width:90px; margin:10px; float:left; display:inline-block;" src="photo_uploads/thumbs/<?=$post_data['profile_image'] ?>" class="thumbnail">	
                         <div class="panel-body">
                         <div><a href="<?=baseURL; ?>u_<?=$post_data['user_name'] ?>"><?=$post_data['full_name'] ?></a><? if($prod['user_id']!=$prod['to_id']){?> > <a href="<?=baseURL; ?>u_<?=$post_data['user_name'] ?>"><?=$to_data['full_name'] ?></a><? } ?></div>
   						     
							 
							 <?=parseSmiley($prod['post']) ?>
                     
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
		?></div></div><? }
		?>
  
        
        
       
      

            
            
         
            		  <div class="panel-footer">
            	   
                <? 
				$post_type=1;
				 include "../like.php"; ?>
                 
    <?  
	
	include"../comments.php"; ?>
                
                
                
                 </div>
                   
         



<? $msg_id++;} ?>
<ul class="pager">

<li id="more<?php echo $msg_id; ?>" class="morebox">
<a href="#" id="<?php echo $msg_id; ?>" class="more">LOAD MORE &rarr;</a>
</li>
</ul>
<?php
}
?>