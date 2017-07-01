<?	$valid_formats = array("jpg", "png", "gif", "bmp");
$path = "images/bg/";
if(isset($_POST['select']))
				{
					$actual_image_name=$_POST['file'];
						mysql_query("UPDATE  tsn_users SET bg='$actual_image_name' WHERE user_id ='$user_id'");
							
								phpredirect(baseURL.'?p=settings&page=themes');
				}
				
				
	if(isset($_POST['upload']))
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			
	
			list($txt, $ext) = explode(".", $name);
					
					
					
			$actual_image_name = time().substr($txt, 5).".".$ext;
			$tmp = $_FILES['photoimg']['tmp_name'];
			if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
										
										
										//convert
							//directory where your uploaded files are stored
							$uploads_directory = $path;

							//check extension of the file
							$str = $_FILES['photoimg']['name'];
							$i = strrpos($str,".");
							if (!$i) { $BAD .= "An error occured."; }
							$l = strlen($str) - $i;
							$ext = substr($str,$i+1,$l);

							//directory + file name of the image
							$upload_filename = $path.$actual_image_name;

					
							if ($ext == "png" || $ext == "gif"){

							//new file name once the picture is converted
							$actual_image_name=time().".jpg";
							$converted_filename = $path. $actual_image_name;


							if ($ext=="png") $new_pic = imagecreatefrompng($upload_filename);
							if ($ext=="gif") $new_pic = imagecreatefromgif($upload_filename);

							// Create a new true color image with the same size
							$w = imagesx($new_pic);
							$h = imagesy($new_pic);
							$white = imagecreatetruecolor($w, $h);

							// Fill the new image with white background
							$bg = imagecolorallocate($white, 255, 255, 255);
							imagefill($white, 0, 0, $bg);

							// Copy original transparent image onto the new image
							imagecopy($white, $new_pic, 0, 0, 0, 0, $w, $h);

							$new_pic = $white;

							imagejpeg($new_pic, $converted_filename);
							imagedestroy($new_pic);
							unlink($upload_filename);

}
										
										
										
										// *** 1) Initialise / load image

							$createThumbs = new resize($path.$actual_image_name);

							// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	$createThumbs -> resizeImage(1660, 12000, 'landscape');
	// *** 3) Save image
	$createThumbs -> saveImage($path.$actual_image_name, 100);
	
	


					
				
							
								mysql_query("UPDATE  tsn_users SET bg='$actual_image_name' WHERE user_id ='$user_id'");
								if(empty($_SESSION['reg_id']))
								phpredirect(baseURL.'u_'.$user_data['user_name']);
								else
								phpredirect(baseURL.'?p=settings&page=themes');
						
									
									
								}
							else
								echo "failed";
								
				
		}
?>

<div class="panel panel-default">
<div class="panel-heading">APPEARANCE</div>
<div class="panel-body">


<div class="panel panel-info">
<div class="panel-heading">Select A theme</div><form  role="form" class="form-group" action="" method="post" enctype="multipart/form-data">
<div class="panel-body">
<div class="form-group">
<? for($i=1; $i<=7; $i++){?>
<div class="col-md-4 col-xs-12">
<div class="thumbnail">
  <img src="images/bg/background (<?=$i ?>).jpg" width="150" height="113">
  <div><input type="radio" name="file" id="radio" value="background (<?=$i ?>).jpg"> SELECT</div></div>
<label>
  
</label>
</div>
<? } ?>
</div>
 <div class="form-group col-md-12"> <input class="btn-info btn " name="select" type="submit" id="select" value="Select The Theme"></div>
</form>



</div>

</div>



<div class="panel panel-info">
<div class="panel-heading">Upload a background</div>

<div class="panel-body">

<form  role="form" class="form-group" action="" method="post" enctype="multipart/form-data">
<div class="form-group">  <label>
    <input type="file" name="photoimg" id="photoimg">
  </label></div>
 <div class="form-group"> <input class="btn-info btn " name="upload" type="submit" id="upload" value="Upload"></div>
</form>
</div>

</div>



</div>

</div>