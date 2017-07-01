<? 
$error_msg ='';
if(isset($_POST['uploadpic']))
{		

		if($_POST['album_title']=='')
		{ 
				$error_msg = '<li>Title field Empty</li>';
		
		}
		if($_POST['post']=='')
		{ 
				$error_msg .= '<li>Description Field Empty</li>';
		}
		if($_POST['post']!='' && $_POST['album_title']!='')
		{
		
				$post=trim (addslashes($_POST['post']));
				$album_title=trim (addslashes($_POST['album_title']));
				$qry->queryInsert("INSERT INTO  tsn_posts(`user_id` ,`post`,`album_title`,`type_id`,`to_id`)
												  VALUES ('$user_id','$post','$album_title','2','$user_id') ");
		
				$query = "select * from  tsn_posts where user_id='".$user_id."' and type_id='2' order by `p_id` desc";
				$post_data = $qry->querySelectSingle($query);
				phpredirect("picuploadID=".$post_data['p_id']);
		}
}



if(isset($_REQUEST['publish']))
{
	$results=$qry->queryExecute("update tsn_posts set  publish='1' where user_id='".$user_id."' and p_id='".$_REQUEST['publish']."'");
phpredirect("albumID_".$_REQUEST['publish']);

}

?>
<? 
if(isset($_GET['del']))
{
	
 $query = "select * from  tsn_uploads where user_id='".$user_id."' and upload_id = '".$_GET['del']."' ";
 $post_data = $qry->querySelectSingle($query);
 $thepid=$post_data['p_id'];
 
 unlink('photo_uploads/'.$post_data['image_name']);
  unlink('photo_uploads/thumbs/'.$post_data['image_name']);
 $sql='DELETE FROM tsn_uploads  WHERE ( upload_id = '.$_GET['del'].' and user_id = '.$user_id.')';

 $qry->queryDelete($sql);
 
 $_SESSION['deleted']=1;
 phpredirect("albumID_".$thepid);
 
 
}
?>
<div class="col-md-10">


<ol style="margin-bottom: 5px;" class="breadcrumb">
        <li> <a class="pull-left" href="<?=baseURL ?>u_<?=$user['user_name'] ?>"> <img width="50" src="photo_uploads/thumbs/<?=$user['profile_image'] ?>" ></a>
</li>
        <li><a href="<?=baseURL ?>">Home</a></li>
        <li><a href="<?=baseURL ?>u_<?=$user['user_name'] ?>"><?=$user['full_name'] ?></a></li>
       <? if(!isset($_REQUEST['album']) && !isset($_REQUEST['upload']) ){ ?>
       <li class="active">Photo Uploads</li>
	   <? }else{
		   
		   $query = "select * from  tsn_posts";
		   if(isset($_REQUEST['album']))
		   $query.=" where p_id=".$_REQUEST['album']." ";
		   if(isset($_REQUEST['upload']))
		   $query.=" where  p_id IN ( select p_id from  tsn_uploads where upload_id=".$_REQUEST['upload'].") ";
		   
		$post_data = $qry->querySelectSingle($query);
		   ?>
       <li><a href="<?=baseURL ?>albumID_<?=$post_data['p_id'] ?>">Photos</a></li>
       <li class="active"><?=$post_data['album_title']?></li><? } ?>
      </ol>
      
<div class="panel panel-default">




<? if(!isset($_REQUEST['p_id']) && !isset($_REQUEST['album'])  && !isset($_REQUEST['upload']))
{ ?>
<!--Add Description -->
<div class="panel-body">
<form method="post" enctype="application/x-www-form-urlencoded" id="uploadform" role="form">
<ul><? echo $error_msg; ?>
</ul>
  <div class="form-group">
    <label for="exampleInputtitle">Album Title</label>
    <input name="album_title" class="form-control" id="exampleInputEmail1" placeholder="Enter title">
  </div>
  <div class="form-group">
    <label for="exampleInputDescription">Description</label>
    <textarea name="post" class="form-control" id="exampleInputPassword1" placeholder="Enter Description"></textarea>
  </div>


  <input name="uploadpic" type="submit" class="btn btn-default" id="uploadpic" value="Upload">
 
</form>
<!--  End of Description -->

</div>
<? }

elseif(isset($_REQUEST['album'])){
	include "album.php";
	}elseif(isset($_REQUEST['upload'])){
	include "includes/photo_view.php";
	}else{
?>
<? $query = "select * from  tsn_posts where p_id='".$_REQUEST['p_id']."'";
				$post_data = $qry->querySelectSingle($query);
				?>
				<div class="panel-heading"><? echo $post_data['album_title'];
				?> </div>
				
                <div class="panel-body">
                <? include "majax/index.php";?>
                </div>
<? } ?>
<br>

</div>
      
  
      
      </div>



<div class="col-md-2">
  <a href="#" class="thumbnail">
      <img src="images/SNP_2922277_en_v0.png" alt="...">
    </a>
</div>