<script type="text/javascript">
$(document).ready(function(){
    $('.confirm').click(function(){
        var answer = confirm("Are you sure you want to delete this post?");
        if (answer){
            return true;
        } else {
            return false;
        }
    });
});

$(function() {
//More Button
$('.more').live("click",function() 
{
var ID = $(this).attr("id");
if(ID)
{
$("#more"+ID).html('<img src="moreajax.gif" />');

$.ajax({
type: "POST",
url: "ajax/ajax_more.php",
data: "lastmsg="+ ID, 
cache: false,
success: function(html){
$("div#updates").append(html);
$("#more"+ID).remove();
}
});
}
else
{
$(".morebox").html('The End');

}


return false;


});
});

</script>
<? 
if(isset($_REQUEST['del']))
{
	
 $sql='DELETE FROM tsn_posts  WHERE ( p_id = '.$_REQUEST['del'].' and to_id = '.$user_id.')';

 $qry->queryDelete($sql);
 phpredirect(baseURL);

	
}


if(isset($_POST['wall_post']))
{		if($_POST['post']!="")
		{
		$post=trim (addslashes($_POST['post']));
		 if(isset($_REQUEST['user_name']))
			$to_id=$profile_id;
			else
			$to_id=$user_id;
			
		$qry->queryInsert("INSERT INTO  tsn_posts(`user_id` ,`post`,`to_id`)
		VALUES ('$user_id','$post','$to_id') ");
		
		$query = "select * from  tsn_posts where user_id='".$user_id."' and to_id='$to_id' order by `p_id` desc";
				$post_data = $qry->querySelectSingle($query);
				

		
		if($to_id!=$user_id){
		//1. wallpost 2. Comment_post 3. Like
		$qry->queryInsert("INSERT INTO  tsn_notification(`p_id` ,`type_id`,`from_id`,`to_id`)
		VALUES ('".$post_data['p_id']."','1','$user_id','$to_id') ");

		}
	phpredirect("?");
		}else{
			echo("<script language='javascript'>alert('You cannot make empty posts.');</script>");
		
		}

}

if(isset($_POST['post_comment']))
{
		$comments=trim (addslashes($_POST['comments']));
		$post_id=$_POST['post_id'];
		$qry->queryInsert("INSERT INTO  tsn_comments(`user_id` ,`comments`,`post_id`)
		VALUES ('$user_id','$comments','$post_id') ");
		phpredirect("?p=profile#p".$post_id);

}

?>
<div class="bs-example">
      
    </div>
    
    <form action="<?
    if(isset($_REQUEST['user_name']))
	echo 'u_'.$profile['user_name']; ?>" method="post" enctype="application/x-www-form-urlencoded" role="form">
    <div class="panel panel-default">
<?      if(isset($_REQUEST['user_name'])){ ?><div class="panel-heading"><b><?=$profile['full_name']?></b></div><? } ?>
  <div class="panel-body">
      
        <textarea name="post" rows="2"  placeholder="What's on your mind?" class="form-control" id="post"></textarea>
         </div>

      
 
   <div class="panel-heading"> <button name="wall_post" type="submit" data-loading-text="Posting..." class="mybtn btn btn-primary">
<span class="glyphicon glyphicon-th-large"></span> Post</button> <button  onclick="location.href='<?=baseURL ?>picupload';" type="button" class="btn  btn-primary pull-right">
  <span class="glyphicon glyphicon-picture"></span> Add Photos
</button></div>
</div> </form>

<script>
// Set up the buttons
$('.mybtn').on('click', function () {
  $(this).button('loading')
})
</script>

<div  class="timeline" id="updates" >

 <?
 
 
 

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
			$msg_id=0;
			$qry_all_prod=$qry->querySelect("select *from   tsn_posts $add_que order BY `p_id` desc LIMIT 0,10");
			foreach($qry_all_prod as $prod)
			{
				
		?>  
        		
        		<? $query = "select * from  tsn_users where user_id='".$prod['user_id']."'";
					$post_data = $qry->querySelectSingle($query);
					
					$query = "select * from  tsn_users where user_id='".$prod['to_id']."'";
					$to_data = $qry->querySelectSingle($query);
					
				?>
      				
                    
     

       
					<div class="panel panel-default"><div class="pull-right" style="  padding: 10px;
  cursor: pointer;
  background: transparent;
  border: 0;
  -webkit-appearance: none; font-size:20px"><a class="confirm" style="text-decoration:none;" href="?del=<?=$prod['p_id'] ?>">&times;</a></div>
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
				 include "like.php"; ?>
                 
    <?  
	
	include"comments.php"; ?>
                
                
                
                 </div>
                   
         



<? $msg_id++;} ?>
</div>
<ul class="pager">

<li id="more<?php echo $msg_id; ?>" class="morebox">
<a href="#" id="<?php echo $msg_id; ?>" class="more">LOAD MORE &rarr;</a>
</li>
</ul>