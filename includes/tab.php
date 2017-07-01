

<!-- Start of Tab -->
<div id="content">
<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
 <? if($mcount>0){?>
<li class="active"><a href="#wall" data-toggle="tab">Wall</a></li><? } ?>
<li  <? if($mcount<=0){?>class="active"<? }?>><a href="#info" data-toggle="tab">Info</a></li>
<? if($mcount>0){?><li><a href="#friends" data-toggle="tab">Friends</a></li><? } ?>
 <li><a href="#photos" data-toggle="tab">Photos</a></li>

</ul>
 <? if($mcount<=0){?><br />
 <div class="alert alert-danger" style=" display:inline-block;">
 <span class="glyphicon glyphicon-lock"></span>&nbsp; &nbsp;
People who aren't friends with <?=$profile['full_name']?> see only some of his profile information.</div><? } ?>

<div id="my-tab-content" class="tab-content">
 <? if($mcount>0){?>
<div class="tab-pane fade in active" id="wall">

<div>

<p>
<? 
$the_profile=1;
include "wall.php"; ?></p>
</div>


</div>
<? }?>

<div class="tab-pane fade <? if($mcount<=0){?>in active<? }?>" id="info">

<p>
<!-- info-->
<div class="panel  panel-default">        
              <div class="panel-heading">
         		 <h3 class="panel-title"><? if($mcount<=0){?><?=$profile['full_name']?><? }else{?>About Me <? } ?>
                 
                 <? if($my_self==1){?>
                 <button  onclick="location.href='<?=baseURL ?>a_edit';" type="button" class="btn btn-default btn-xs pull-right">
  <span class="glyphicon glyphicon-edit"></span> Edit
</button><? } ?>

</h3>
      		  </div>
      		  <div class="panel-body" id="custom-info">
        	    			<table width="100%" class="table">
  <tr>
    <td width="31%"><strong>Basic Info</strong></td>
    <td width="69%">
    <div id="sub">
    <table width="100%" border="0">
      <tr>
        <td width="43%"><strong>Gender</strong></td>
        <td width="57%"><?=$profile['gender']?></td>
        </tr>
      <tr>
        <td><strong>Birthday</strong></td>
        <td><? 


$date = date_create($profile['birthday']);
echo date_format($date, 'd M, Y');
	 ?></td>
        </tr>
      <tr>
        <td><strong>Relationship Staus</strong></td>
        <td><? 


echo ($profile['relationship_status']);

	 ?></td>
        </tr>
      <tr>
        <td><strong>Curent City</strong></td>
        <td><? 


echo ($profile['current_city']);

	 ?></td>
      </tr>
      <tr>
        <td><strong>Hometown</strong></td>
        <td><? 


echo ($profile['hometown']);

	 ?></td>
        </tr>
      </table>
    </div>
    </td>
  </tr>
  <tr>
    <td>Bio</td>
    <td><? 


echo ($profile['bio']);

	 ?></td>
  </tr>
  <tr>
    <td>Favorite Quotations</td>
    <td><? 


echo ($profile['quotes']);

	 ?></td>
  </tr>
</table>
    		
 							
							

               
  
        </div>
        
        </div>
<!-- info -->














 <? if($mcount>0){?>

<!-- info-->
<div class="panel  panel-default">        
              <div class="panel-heading">
         		 <h3 class="panel-title">Work and Education   <? if($my_self==1){?>
                 <button  onclick="location.href='<?=baseURL ?>w_edit';" type="button" class="btn btn-default btn-xs pull-right">
  <span class="glyphicon glyphicon-edit"></span> Edit
</button><? } ?>
</h3>
      		  </div>
      		  <div class="panel-body" id="custom-info">
        	    			<table width="100%" class="table">
  <tr>
    <td width="18%" valign="middle"><strong>Edcation</strong></td>
    <td width="82%">
    <table  class="table table-striped" width="100%" border="0">
      <thead>
        <tr>
          <td width="63%"><strong>Institution </strong></td>
          <td colspan="2" align="right"><strong>Year</strong></td>
          </tr>
      </thead>
      <? 		$qry_all_prod=$qry->querySelect("select *from   tsn_info where info_type=1 and user_id='".$user_id."'  order BY `date_started` desc");
			foreach($qry_all_prod as $info)
			{
				
				?>
      <tr>
        <td><?=$info['name'] ?></td>
        <td align="right"><? $Ym=explode('-',$info['date_started']);
			echo $Ym[0];
	?></td>
        </tr>
      <? } ?>
      </table>
    </td>
  </tr>
  <tr>
    <td valign="middle"><strong>Work</strong></td>
    <td><table  class="table table-striped" width="100%" border="0">
      <thead>
        <tr>
          <td width="63%"><strong>Institution </strong></td>
          <td colspan="2" align="right"><strong>Year</strong></td>
          </tr>
      </thead>
      <? 		$qry_all_prod=$qry->querySelect("select *from   tsn_info where info_type=2 and user_id='".$user_id."'  order BY `date_started` desc");
			foreach($qry_all_prod as $info)
			{
				
				?>
      <tr>
        <td><?=$info['name'] ?></td>
        <td align="right"><? $Ym=explode('-',$info['date_started']);
			echo $Ym[0];
	?></td>
        </tr>
      <? } ?>
      </table></td>
  </tr>
</table>
    		
 							
							

               
  
        </div>
        
        </div>
<!-- info -->
</p><? }?>
</div>

<!-- -->

<div class="tab-pane fade" id="friends">

<p>
<!-- -->  <ul class="media-list  list-group">
          
			  <? 
			$qry_all_prod=$qry->querySelect("select *from  tsn_rel where userID='$profile_id' OR friendID='$profile_id' order BY `rel_ID` desc");
			foreach($qry_all_prod as $friend_data)
			{  
			$theID=$friend_data['friendID'];
			if($theID==$profile_id)
			$theID=$friend_data['userID'];
			
			$query = "select * from  tsn_users where user_id='".$theID."'";
					$post_data = $qry->querySelectSingle($query);?><li class="media list-group-item"> 

     <a class="pull-left " href="<?=baseURL ?>u_<?=$post_data['user_name'] ?>" >
      <img width="64" src="photo_uploads/thumbs/<?=$post_data['profile_image'] ?>" >
    </a>
      <div class="media-body">
        <h4><?=$post_data['full_name'] ?></h4>
    
  </div>
			
	
       
      </li>
<? }?></ul>
<!-- -->

</p>
</div>
<!-- -->



<div class="tab-pane fade" id="photos">

<p>
<!-- -->
<div class="panel panel-default">
  <div class="panel-heading">Photos       <? if($my_self==1){?>
                 <button  onclick="location.href='<?=baseURL ?>picupload';" type="button" class="btn btn-default btn-xs pull-right">
  <span class="glyphicon glyphicon-picture"></span> Add Photos
</button><? } ?>
</div>
  <div class="panel-body">
   
<div class="row">
		<?	
		$result="select *from   tsn_posts where user_id='$profile_id' and type_id='2' and publish=1 order BY `p_id` desc";
		 
$num_rows =$qry->numRows($result);
if($num_rows==0 || $mcount<=0){ ?>
<h3 align="center" style="color:#CCC;">No Photos Found</h3>
<? }else{

		$qry_all_prod=$qry->querySelect($result);
			foreach($qry_all_prod as $prod)
			{
				$query = "select * from tsn_uploads where p_id='".$prod['p_id']."'";
				$img = $qry->querySelectSingle($query);
				?>
			
  				<div class="col-sm-6 col-md-4">
   					   <a href="albumID_<? echo $prod['p_id']?>" class="thumbnail">
      <img src="photo_uploads/thumbs/<?=$img['image_name'] ?>" title="<? echo $prod['album_title']?>">
      
      <div align="center"><? echo $prod['album_title']?></div>
    </a>
   					    
   				
            </div>
            <? } 
			
			}?>
            
            </div>
  </div>
</div>
<!-- -->

</p>
</div>

















</div>
</div>
 
 
<script type="text/javascript">
jQuery(document).ready(function ($) {
$('#tabs').tab();
});
</script>
