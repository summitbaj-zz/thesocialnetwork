<div class="col-md-2"> <div class="thumbnail">
     <a href="<?=baseURL ?>u_<?=$user['user_name'] ?>"> <img width="150" src="photo_uploads/thumbs/<?=$user['profile_image'] ?>" ></a>
     <br />
      <p align="center"><a href="<?=baseURL ?>u_<?=$user['user_name'] ?>"><?=$user['full_name'] ?></a></p>
      
      </div></div>

<div class="col-md-8">
<? 
if(isset($_REQUEST['post_id']))
include "post.php";
else
include "wall.php";?>
</div>

<div class="col-md-2">
  <a href="#" class="thumbnail">
      <img src="images/SNP_2922277_en_v0.png" alt="...">
    </a>
</div>