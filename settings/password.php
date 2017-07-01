<?	$valid_formats = array("jpg", "png", "gif", "bmp");
$path = "images/bg/";
if(isset($_POST['update']))
				{
					$psw=$user['password'];
					$old=md5($_REQUEST['current']);
					$new=md5($_REQUEST['new']);
					$re=md5($_REQUEST['re-enter']);
					
					if($psw!=$old){
						$_SESSION['oldm']='Current Password doesnt match';
					}
					elseif($new!=$re)
					{
						$_SESSION['oldm']='Re-Enter Password doesnt match';
						}else{
						

				
						mysql_query("UPDATE  tsn_users SET password='$new' WHERE user_id ='$user_id'");
							
								phpredirect(baseURL.'?p=settings&page=password');
								}
				}
				
				
?>

<div class="panel panel-default">
<div class="panel-heading">PASSWORD</div>
<div class="panel-body">


<div class="panel panel-info">
<div class="panel-heading">Change your password or recover your current one.</div>
<? if(isset($_SESSION['oldm'])){?><?=$_SESSION['oldm'] ?><? } 
unset($_SESSION['oldm']);
?>
<form  role="form" class="form-group" action="" method="post" enctype="multipart/form-data">
<div class="panel-body">
<div class="form-group">
<div class="col-md-4 col-xs-12">Current Password</div>
<div class="col-md-8 col-xs-12"><input class="form-control" name="current" type="password" /></div>
</div>
<br />
<div class="form-group">
<div class="col-md-4 col-xs-12">New Password</div>
<div class="col-md-8 col-xs-12"><input class="form-control" name="new" type="password" /></div>
</div>
<br />
<div class="form-group">
<div class="col-md-4 col-xs-12">Re-enter Password</div>
<div class="col-md-8 col-xs-12"><input class="form-control" name="re-enter" type="password" /></div>
</div>
<br />
<br />
 <div class="form-group col-md-12"> <input class="btn-info btn " name="update" type="submit" id="update" value="Save Changes"></div>
</form>



</div>

</div>







</div>
</div>