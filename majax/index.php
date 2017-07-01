<script src="js/jquery.wallform.js"></script>
<script>
 $(document).ready(function() { 
		$(".publish").hide();
            $('#photoimg').die('click').live('change', function()			{ 
			           //$("#preview").html('');
			    
				$("#imageform").ajaxForm({target: '#preview', 
				     beforeSubmit:function(){ 
					
					console.log('ttest');
					$("#imageloadstatus").show();
					 $("#imageloadbutton").hide();
					 }, 
					success:function(){ 
				    console.log('test');
					 $("#imageloadstatus").hide();
					 $("#imageloadbutton").show();
					}, 
					error:function(){ 
					console.log('xtest');
					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();
				
				$(".publish").show();
					
		
			});
        }); 
</script>

<style>


#preview
{
color:#cc0000;
font-size:12px
}
.imgList 
{
max-height:150px;
margin-left:5px;
border:1px solid #dedede;
padding:4px;	
float:left;	
}

</style>
<body>

<div>
<h3>Upload your images</h3> 
<div id='preview'>
</div>
	
<form id="imageform" method="post" enctype="multipart/form-data" action='majax/ajaxImageUpload.php' style="clear:both">

<div id='imageloadstatus' style='display:none'><img src="loader.gif" alt="Uploading...."/>

</div><a href="publishID=<?=$_GET['p_id'] ?>"  class="btn btn-primary publish"  data-loading-text="Posting..." role="button">Publish >></a>
<div id='imageloadbutton'>
  <input name="p_id" type="hidden" id="p_id" value="<?=$_GET['p_id'] ?>">
  <input name="user_id" type="hidden" id="user_id" value="<?=$user_id ?>">
<input type="file" name="photos[]" id="photoimg" multiple="true" />
</div>
</form>


</div>
