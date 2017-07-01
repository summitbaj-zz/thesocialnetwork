<div class="col-md-4"> 





  <div class="thumbnail">
    
    <div class="media panel panel-info">
     
  <a class="pull-left" href="#">
     <img style="width:70px;" src="photo_uploads/thumbs/<?=$user['profile_image'] ?>">
  </a>
         		 <h3 style="font-weight:bold; margin-top:10px;" class="panel-title"><?=$user['full_name']?></h3>
      
  <div class="media-body">
    <a href="<?=baseURL ?>a_edit">Edit Profile</a></div>
</div>
  </div>
<div class="list-group col-md-12">
  
  <ul class="nav nav-pills nav-stacked" style="max-width: 260px;">
      <li>
        <a  class="list-group-item" href="?p=settings&page=themes">
         Themes
        </a></li>
      <li>
        <a  class="list-group-item" href="?p=settings&page=password">
        Password</a></li>
  </ul>
</div>

</div>

<div class="col-md-6">
<? include 'settings/'.$_REQUEST['page'].'.php'; ?>
</div>

<div class="col-md-2">
  <a href="#" class="thumbnail">
      <img src="images/SNP_2922277_en_v0.png" alt="...">
    </a>
</div>