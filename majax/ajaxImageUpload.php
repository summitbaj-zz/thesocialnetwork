 <?php
$path='../';
$the_profile=0;
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";
include $path."class/resize-class.php";

$session_id=$_POST['p_id']; //$session id
$user_id=$_POST['user_id'];
define ("MAX_SIZE","9000"); 
function getExtension($str)
{
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}


$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") 
{
	
    $myupload = "photo_uploads/"; //a directory inside
	$uploaddir="../".$myupload;
    foreach ($_FILES['photos']['name'] as $name => $value)
    {
	
        $filename = stripslashes($_FILES['photos']['name'][$name]);
        $size=filesize($_FILES['photos']['tmp_name'][$name]);
        //get the extension of the file in a lower case format
          $ext = getExtension($filename);
          $ext = strtolower($ext);
     	
         if(in_array($ext,$valid_formats))
         {
	       if ($size < (MAX_SIZE*1024))
	       {
			   $image_name=time().$filename;
			   echo "<img src='".$myupload."thumbs/".$image_name."' class='imgList'>";
		   $newname=$uploaddir.$image_name;
           
           if (move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname)) 
           {
			   
				// *** 1) Initialise / load image

				$createThumbs = new resize($newname);

				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)

				$createThumbs -> resizeImage(150, 150, 'crop');

				// *** 3) Save image

				$createThumbs -> saveImage($uploaddir."thumbs/".$image_name, 100);
	
	
	
	       $time=time();
	       mysql_query("INSERT INTO  tsn_uploads(image_name,p_id,user_id) VALUES('$image_name','$session_id','$user_id')");
	       }
	       else
	       {
	        echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>';
            }

	       }
		   else
		   {
			echo '<span class="imgList">You have exceeded the size limit!</span>';
          
	       }
       
          }
          else
         { 
	     	echo '<span class="imgList">Unknown extension!</span>';
           
	     }
           
     }
}

?>