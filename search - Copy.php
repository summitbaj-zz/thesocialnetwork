<?
        $search='';
		if(isset($_REQUEST['q']))
		$search=$_REQUEST['q'];?><div class="col-md-10">
<ol style="margin-bottom: 5px;" class="breadcrumb">
        <li> <a class="pull-left" href="<?=baseURL ?>u_<?=$user['user_name'] ?>"> <img width="50" src="photo_uploads/thumbs/<?=$user['profile_image'] ?>" ></a>
</li>
        <li><a href="<?=baseURL ?>">Home</a></li>
        <li class="active">Search</li>
        <li class="active"><?=$search ?></li>

      </ol>
      
      <br />

<ul class="media-list">		<?
		
			$qry_all_prod=$qry->querySelect("SELECT *
  FROM tsn_users
 WHERE full_name like '%$search%'
 GROUP BY full_name
 ORDER BY CASE WHEN full_name like '$search %' THEN 0
               WHEN full_name like '$search%' THEN 1
               WHEN full_name like '% $search%' THEN 2
               ELSE 3
          END, full_name");
			foreach($qry_all_prod as $prod)
			{ 
			$work_data = $qry->querySelectSingle("select *from  tsn_info where info_type=2 and user_id='".$prod['user_id']."'  order BY `date_started`");
			$edu_data = $qry->querySelectSingle("select *from  tsn_info where info_type=1 and user_id='".$prod['user_id']."'  order BY `date_started`");
			
			//kjhkljlk
			
			$profile_id=$prod['user_id'];
			$my_self=0;
if($profile_id==$user_id)
$my_self=1;

$f_sql = mysql_query('SELECT COUNT(*) FROM   tsn_rel WHERE (( userID = '.$user_id.' and friendID = '.$profile_id.') OR ( friendID = '.$user_id.' and userID = '.$profile_id.')) and status = 1 ');
		$fcount = mysql_result($f_sql, 0); 

		$pcount = mysql_result(mysql_query('SELECT COUNT(*) FROM   tsn_rel WHERE (( userID = '.$user_id.' and friendID = '.$profile_id.') OR ( friendID = '.$user_id.' and userID = '.$profile_id.')) and status = 0 '), 0); 

$mcount=$fcount;
if($my_self==1)
$mcount=1;
			
			//ijkljlkjlkj
			
			
			?>
			

  <li class="media"><div class="panel panel-default">
  <div class="panel-body">
    <a class="pull-left" style="margin-right:10px;" href="<?=baseURL.'u_'.$prod['user_name'] ?>">
     <img src="photo_uploads/thumbs/<?=$prod['profile_image'] ?>" class="thumbnail">	
    </a>
    <div class="media-body">
      <div>
      <h4 class="media-heading">
         <b><a href="<?=baseURL.'u_'.$prod['user_name'] ?>">
	  <?=$prod['full_name'] ?></a></b> 
      </h4></div>
     <? if($work_data['name']!=''){?><div>Works at <?=$work_data['name']?></div><? } ?>
<? if($edu_data['name']!=''){?><div>Studied at <?=$edu_data['name']?></div><? } ?>
<? if($prod['current_city']!=''){?><div>Lives in <? 


echo ($prod['current_city']);

	 ?></div><? } ?>

</div>




    <? if($my_self==0){?>
    <p style="margin-top:20px;"><? if($fcount>0){?><a href="<?=baseURL ?>u_<?=$prod['user_name']?>&rfriends"  class="btn btn-danger"  data-loading-text="Posting..." role="button">Unfriend</a><? }elseif($pcount>0){?><a href="#" class="btn btn-default disabled" role="button">Pending Request</a><? } else{ ?><a href="<?=baseURL ?>u_<?=$prod['user_name']?>&addfriends"  id="add_friend" class="btn btn-primary"  data-loading-text="Posting..." role="button">Send Friend Request</a><? } ?> <a href="<?=baseURL ?>c_<?=$prod['user_name']?>" class="btn btn-default" role="button">Message</a></p>
    <? } ?>
    
    </div>
    </div>
  </li>


			
			<? } ?></ul>


</div><div class="col-md-2">
  <a href="#" class="thumbnail">
      <img src="images/SNP_2922277_en_v0.png" alt="...">
    </a>
</div>