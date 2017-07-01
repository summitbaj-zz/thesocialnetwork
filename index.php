<?
session_start();
$path='';
$the_profile=0;
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";
include $path."class/resize-class.php";
include $path."class/functions.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to The Social Network</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link rel="stylesheet"  href="css/bootstrap.css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<!-- Latest compiled and minified CSS -->
<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.css">

<script type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
<script language="javascript" src="chat/jquery.timers-1.0.0.js"></script>

<script type="text/javascript">
$(function() {

$('form[name="cForm"]').live('submit', function ()  {

var name = $("#name").val();
var email = $("#email").val();
var post_id = $('input[name="post_id"]',this).val();
var post_type = $('input[name="post_type"]',this).val();
var user_id = $('input[name="user_id"]',this).val();

	var comment = $('textarea[name="comment"]',this).val();
		
    var dataString = 'name='+ name + '&user_id=' + user_id + '&post_type=' + post_type + '&comment=' + comment + '&post_id=' + post_id;
	
	if(comment=='')
     {
    alert('Please Give Valid Comment');
     }
	else
	{
	$("#flash").show();
	$("#flash").fadeIn(400).html('');
$.ajax({
		type: "POST",
  url: "commentajax.php",
   data: dataString,
  cache: false,
  success: function(html){
 
  $("ol#update"+ post_id).append(html);
  $("ol#update li:last").fadeIn("slow");

    document.getElementById('comment'+post_id).value='';


 
  $("#flash").hide();
	
  }
 });
}
return false;
	});




});


</script>
<script src="js/globalize.js"></script> 

<script>


// Set up the buttons
setInterval(function () {
   //Get the ID of the button that was clicked on



   $.ajax({
      url: "ajax/ajax-lastlogin.php", //This is the page where you will handle your SQL insert
      type: "post",
      data: "id=<?=$user_id ?>", //The data your sending to some-page.php
      success: function(){
          
      },
      error:function(){
          console.log("AJAX request was a failure");
      }   
    });

   }, 1000 ); 	


   
</script>


<? if($user['location'] ==1 && !empty($_SESSION['user_name']))
{
?>
<script>
var int=self.setInterval(function(){getLocation()},1000);
var x=document.getElementById("demo");

function getLocation()
  {

    navigator.geolocation.getCurrentPosition(showPosition);

  }
function showPosition(position)
  {
	     $.ajax({
      url: "location/location.php", //This is the page where you will handle your SQL insert
      type: "post",
      data: {lat: position.coords.latitude, lon: position.coords.longitude, user_id:<?=$user_id ?>} , //The data your sending to some-page.php
      success: function(){
		
      }
    });
	x.innerHTML="Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;

  }
  

</script>



<? } ?>

</head>
<? 
if(!empty($_SESSION['user_name']))
{
if(isset($_REQUEST['user_name']))
{
	$query = "select * from  tsn_users where user_name='".$_REQUEST['user_name']."'";
}else{
	$query = "select * from  tsn_users where user_id='".$user_id."'";
	}	
	$profile = $qry->querySelectSingle($query);
	$profile_id=$profile['user_id'];
}

$bg='background (1).jpg';
if(!empty($_SESSION['user_name']))
{
	
	$bg=$user['bg'];
	
	if(isset($_REQUEST['user_name']))
	$bg=$profile['bg'];
	
	if($bg=="")
	$bg='background (1).jpg';
}
?>
<body background="images/bg/<?=$bg ?>">
<? include"modal/notification.php"; ?>
<? include"modal/messages.php"; ?>
<? include"modal/addfriends.php";?>


 <div class="container" align="left">
<nav role="navigation" class=" header navbar navbar-inverse  navbar-fixed-top">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button data-target="#bs-example-navbar-collapse-9" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?=baseURL?>" class="navbar-brand" style="opacity:0;">The Social Networking Site</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
<?      if(isset($_SESSION['user_name'])){?>
   <div id="bs-example-navbar-collapse-9" class="navbar-collapse collapse pull-right" style="height: 1px;">
           <form role="search" action="index.php" method="get" class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" name="q" placeholder="Search" class="form-control">
              <input type="hidden" name="p" value="search" placeholder="Search" class="form-control">
            </div>
            <button class="btn btn-default" type="submit">Submit</button>
          </form>
          <ul class="nav navbar-nav">
          
            <li><a href="<?=baseURL ?>"><span class="glyphicon glyphicon-home " style="color:#FFF;"></span></a></li>
            <li><a title="Where are my friends now?" href="<?=baseURL ?>where"><span class="glyphicon glyphicon glyphicon-map-marker" style=" font-weight:normal; color:#FFF;"></span></a></li>
            <li><a href="#" style="font-weight:normal;" data-toggle="modal" data-target="#myNotify">
  										<span class="glyphicon glyphicon-globe"  style="color:#FFF; font-weight:normal; "></span> <? if($notify_number!=0){ ?><span class="notifySpan badge"><?=$notify_number?></span><? } ?>
                                        
                                         </a>
             </li>
            <li><a href="#" data-toggle="modal" data-target="#myModal">
  										<span class="glyphicon glyphicon-user"  style="color:#FFF;"></span>
                                         <? if($friend_request!=0){ ?><span class="friendSpan badge"><?=$friend_request?></span><? } ?>
                                         </a>
             </li>
            <li><a href="#" class="  dropdown-toggle" data-toggle="dropdown"  style="color:#FFF;"><span class="glyphicon glyphicon-list"  style="color:#FFF;"></span> &nbsp;&nbsp;My Account <span class="caret"></span></a> 
  <ul class="dropdown-menu" role="menu">
 

  
  
  


    <li><a href='<?=baseURL ?>u_<?=$user['user_name'] ?>'>Profile</a></li>
    <li><a href='<?=baseURL ?>?p=settings&page=themes'>Settings</a></li>
    <li class="divider"></li>
    
    <li><a href='<?=baseURL ?>?logout'>Log Out</a></li>

  </ul>
  </li>
          </ul>
        </div><!-- /.navbar-collapse --><? } ?>
      </nav>






</div>
<div style="height:70px">

</div>
<? 
if(isset($_REQUEST['p']))
$page=$_REQUEST['p'];
else
$page='';
if(empty($_SESSION['user_name']))
{
switch($page)
		{
			case 'forget':
			include "forget.php";
			break;
			default:
			include "register.php";
			break;
		}

}
else{?>
<div class="container">
        

		<? switch($page)
		{
			case 'login_uploadpic':
			include "login_uploadpic.php";
			break;
			case 'photo_upload':
			include "photo_upload.php";
			break;
			case 'profile':
			include "profile.php";
			break;
			case 'search':
			include "search.php";
			break;
			case 'user':
			include "user.php";
			break;
			case 'chat':
			include "chat.php";
			break;
			case 'settings':
			include "settings.php";
			break;
			case 'location':
			include "location.php";
			break;
			default:
			include "front.php";
			break;
		} ?></div><?
}
?>
      
        

<p style=" margin-bottom:50px;"> </p>
<!-- -->
<? if(!empty($_SESSION['user_name'])){?>
<div id="footer" style="position:fixed; bottom:0; padding:10px; background-color:#eee; width:100%;">
      <div class="container">
      
        <div class="pull-left"><div>© 2013 TheSocialNetwork </div><div><a href="http://summitb.com">Summit Bajracharya</a>.</div></div>

  <div class="btn-group dropup pull-right">
  <button onclick="window.location.href='<? echo baseURL."?location=".$user['location']; ?>'"  style="height:35px;" class="btn btn btn-default" >
<span class="glyphicon glyphicon-map-marker"></span> <span class="badge" style="color:#fff; background-color:#<? if($user['location']==1){ ?>060;">ON<? }else echo"888;\">OFF"; ?></span>
</button>

  <button  style="height:35px;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Friends Online &nbsp;&nbsp;&nbsp;&nbsp;<span class="caret"></span>
  </button>
<button style="height:35px;" class="btn btn btn-default" data-toggle="modal" data-target="#myMessages">
<span class="glyphicon glyphicon-comment"></span> <? if($message_number!=0){ ?><span class="badge" style="color:#666; background-color:#CCC;"><?=$message_number?></span><? } ?>
</button>
  <ul class="dropdown-menu" role="menu" style="width:220px;">
            <? 
			$k=0;
			$profile_id=$user_id;
			$qry_all_prod=$qry->querySelect("select *from  tsn_rel where userID='$profile_id' OR friendID='$profile_id' order BY `rel_ID` desc");
			foreach($qry_all_prod as $friend_data)
			{  
					$theID=$friend_data['friendID'];
					if($theID==$profile_id)
					$theID=$friend_data['userID'];
			
					$query = "select * from  tsn_users where user_id='".$theID."'";
					$post_data = $qry->querySelectSingle($query);
		if(time_diff(strtotime($post_data['last_login']))<5)
		{
					?>
                    <li>
		  <div class="media" style="padding:5px; margin:2px;">  <a href="c_<?=$post_data['user_name'] ?>">
          <span class="glyphicon glyphicon-stop pull-right" style="color:#090;"></span>
  <div  class="pull-left">
      <img style="margin-right:10px;" src="photo_uploads/thumbs/<?=$post_data['profile_image'] ?>" width="30"></div>
 

			<? echo $post_data['full_name'] ?>
            
            </a></div></li><? $k++; }
	} 
	
	
			if($k==0){?>
					<li  style="padding:5px; margin:2px; text-align:center;">No friends Online</li>
			<? 	} ?>    
  </ul>
</div>
<div id="demo"></div>

      </div>
    </div><? } ?>
    <!-- -->

</div>
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.js"></script>
</body>
</html>