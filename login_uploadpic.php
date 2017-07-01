<?php $up_id = uniqid(); ?>
<link href="css/style_progress.css" rel="stylesheet" type="text/css" />
<script>

$(document).ready(function() { 
//

//show the progress bar only if a file field was clicked
	var show_bar = 0;
    $('input[type="file"]').click(function(){
		show_bar = 1;
    });

//show iframe on form submit
    $("#form1").submit(function(){

		if (show_bar === 1) { 
			$('#upload_frame').show();
			function set () {
				$('#upload_frame').attr('src','ajax/ajax-upload_frame.php?up_id=<?php echo $up_id; ?>');
			}
			setTimeout(set);
		}
    });
//

});

</script>


  <div class="col-md-6">
  <div class="panel panel-default">
  <div class="panel-heading">Upload Your Profile Picture</div>
  
<form method="post"  name="form1" id="form1" action="" enctype="multipart/form-data">  <div class="panel-body">
        <br />
      <? 


$session_id=$_SESSION['unique_id']; //$session id

$path = "photo_uploads/";

//check file extension



?>


<?php

	$valid_formats = array("jpg", "png", "gif", "bmp");
	if(isset($_POST['submit']))
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
	$createThumbs -> resizeImage(900, 1200, 'landscape');
	// *** 3) Save image
	$createThumbs -> saveImage($path.$actual_image_name, 100);
	
	
	$createThumbs -> resizeImage(320, 1200, 'landscape');
	$createThumbs -> saveImage($path."medium_".$actual_image_name, 100);

	$createThumbs -> resizeImage(150, 150, 'crop');
	$createThumbs -> saveImage($path."thumbs/".$actual_image_name, 100);


							
								$user_data = $qry->querySelectSingle("select * from  tsn_users where unique_id ='$session_id' ");
								$post_data = $qry->querySelectSingle("select * from  tsn_posts where 
																	 to_id ='".$user_data['user_id']."' and 
																	 album_title= 'Profile Pictures'");
				
								mysql_query("INSERT INTO  tsn_uploads(image_name,p_id,user_id) VALUES
																	 ('$actual_image_name','".$post_data['p_id']."','".$post_data['user_id']."')");
								
								mysql_query("UPDATE  tsn_users SET profile_image='$actual_image_name' WHERE unique_id ='$session_id'");
								if(empty($_SESSION['reg_id']))
								phpredirect(baseURL.'u_'.$user_data['user_name']);
								else
								phpredirect(baseURL.'a_edit');
								
									$image="<h1>Please drag 	on the image</h1><img src='photo_uploads/".$actual_image_name."' id=\"photo\" style='max-width:500px' >";
									
									
								}
							else
								echo "failed";
								
				
		}
?>






<!--APC hidden field-->
    <input type="hidden" name="APC_UPLOAD_PROGRESS" id="progress_key" value="<?php echo $up_id; ?>"/>
<!---->



	Upload your image <input type="file" name="photoimg" id="photoimg" />
	<input type="hidden" name="image_name" id="image_name" value="<?php echo($actual_image_name)?>" />
	

<!--Include the iframe-->
    <br />
    <iframe id="upload_frame" name="upload_frame" frameborder="0" border="0" src="" scrolling="no" scrollbar="no" > </iframe>
    <br />
<!---->


  </div>
  <div style="display:inline-block; width:100%;" class="panel-footer"><input class="vpb_general_button" type="submit" name="submit" value="Submit" /><div class="pull-right"><a href="<?=baseURL.'a_edit'?>">Skip This Step ></a></div></div>
</form>
</div></div>