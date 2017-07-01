<? if(isset($_POST['change']))
				{
					
 


					$psw=rand(10000,99999);
					$encrypt_psw=md5($psw);
					$email=$_REQUEST['email'];
					$header = "Reply-To: Some One <info@summitb.com>\r\n"; 
    				$header .= "Return-Path: Some One <info@summitb.com>\r\n"; 
    				$header .= "From: Some One <info@summitb.com>\r\n"; 
    				$header .= "Organization: The Social network\r\n"; 
    				$header .= "Content-Type: text/plain\r\n"; 
 
   				//	mail($email, "Password Recovery", "Your Passowrd is ".$psw.".", $header); 
						mysql_query("UPDATE  tsn_users SET password='$encrypt_psw' WHERE email_address ='$email'");
							
								phpredirect(baseURL.'forget#done');
								$_SESSION['sucess']='y';
				}
				
				?><div class="container">
<div class="row">
<div class="col-md-8 col-xs-12">
<div class="panel panel-default">
<div class="panel-heading">Forgot Password</div>
<div class="panel-body">
<? if(!empty($_SESSION['sucess'])){ ?>
<div class="alert alert-success" style=" display:inline-block;">Password has been changed and sent successfully to your email address.</div><? } unset($_SESSION['sucess']);?>
<form action="" method="post" enctype="application/x-www-form-urlencoded">
<div class="form-group">Please Enter your Email:</div>
<div class="form-group"><input name="email" class="form-control" type="text" id="email" /></div>
<input name="change" type="submit" class="btn btn-info" value="Submit" id="change" />

</form>

</div>
</div>
</div>
</div>
</div>