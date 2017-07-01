

<div class="col-md-4"> 
    <div class="thumbnail">
      <img src="uploads/medium_<?=$user['profile_image']?>" width="280">
      <div class="caption">
   
        
        <div class="panel panel-info">        
              <div class="panel-heading">
         		 <h3 class="panel-title">Information</h3>
      		  </div>
      		  <div class="panel-body">
        	    			
 							
   							<div><b>Birthday</b></div>
 							<div>May 14,1984</div>
                            
                            <div><b>Current City</b></div>
 							<div>PA Alto, CA</div>
 							
							

               
  
        </div>
        
        </div>
 
        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
      </div>
    </div>
    

  


</div>

<div class="col-md-6">

<!-- Start of Tab -->
<div id="content">
<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
<li class="active"><a href="#wall" data-toggle="tab">Wall</a></li>
<li><a href="#info" data-toggle="tab">Info</a></li>
<li><a href="#photos" data-toggle="tab">Photos</a></li>
</ul>
<div id="my-tab-content" class="tab-content">
<div class="tab-pane fade in active" id="wall">

<div>
<p>
<h3><?=$user['full_name']?></h3>
<? include "wall.php"; ?></p>
</div>


</div>
<div class="tab-pane fade" id="info">

<p>
<!-- info-->
<div class="panel  panel-default">        
              <div class="panel-heading">
         		 <h3 class="panel-title">About Me</h3>
      		  </div>
      		  <div class="panel-body" id="custom-info">
        	    			<table width="100%" class="table">
  <tr>
    <td width="18%"><strong>Basic Info</strong></td>
    <td width="82%">
    <div id="sub">
    <table width="100%" border="0">
      <tr>
        <td><strong>Sex</strong></td>
        <td>Male</td>
        </tr>
      <tr>
        <td><strong>Birthday</strong></td>
        <td>30 March, 1984</td>
        </tr>
      <tr>
        <td><strong>Parents</strong></td>
        <td>Edward Zuckere<br>
          Edward Zuckere<br>
          Edward Zuckere</td>
        </tr>
      <tr>
        <td><strong>Sibblings</strong></td>
        <td>Edward Zuckere<br>
          Edward Zuckere<br>
          Edward Zuckere<br>
          Edward Zuckere</td>
        </tr>
      <tr>
        <td><strong>Curent City</strong></td>
        <td>Edward Zuckere</td>
        </tr>
      <tr>
        <td><strong>Hometown</strong></td>
        <td>Edward Zuckere</td>
        </tr>
      </table>
    </div>
    </td>
  </tr>
  <tr>
    <td>Bio</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Favorite Quotations</td>
    <td>&nbsp;</td>
  </tr>
</table>
    		
 							
							

               
  
        </div>
        
        </div>
<!-- info -->


<!-- info-->
<div class="panel  panel-default">        
              <div class="panel-heading">
         		 <h3 class="panel-title">Work and Education</h3>
      		  </div>
      		  <div class="panel-body" id="custom-info">
        	    			<table width="100%" class="table">
  <tr>
    <td width="18%"><strong>Basic Info</strong></td>
    <td width="82%">
    <div id="sub">
    <table width="100%" border="0">
      <tr>
        <td><strong>Sex</strong></td>
        <td>Male</td>
        </tr>
      <tr>
        <td><strong>Birthday</strong></td>
        <td>30 March, 1984</td>
        </tr>
      <tr>
        <td><strong>Parents</strong></td>
        <td>Edward Zuckere<br>
          Edward Zuckere<br>
          Edward Zuckere</td>
        </tr>
      <tr>
        <td><strong>Sibblings</strong></td>
        <td>Edward Zuckere<br>
          Edward Zuckere<br>
          Edward Zuckere<br>
          Edward Zuckere</td>
        </tr>
      <tr>
        <td><strong>Curent City</strong></td>
        <td>Edward Zuckere</td>
        </tr>
      <tr>
        <td><strong>Hometown</strong></td>
        <td>Edward Zuckere</td>
        </tr>
      </table>
    </div>
    </td>
  </tr>
  <tr>
    <td>Bio</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Favorite Quotations</td>
    <td>&nbsp;</td>
  </tr>
</table>
    		
 							
							

               
  
        </div>
        
        </div>
<!-- info -->
</p>
</div>
<div class="tab-pane fade" id="photos">

<p>
<!-- -->
<div class="thumbnail">
      <img data-src="holder.js/300x200" alt="...">
      <div class="caption">
        <h3>Thumbnail label</h3>
       
      </div>
</div>
<!-- -->

</p>
</div>
</div>
</div>
 
 
<script type="text/javascript">
jQuery(document).ready(function ($) {
$('#tabs').tab();
});
</script>
</div>
<!-- End of tab-->



<div class="col-md-2">
  <a href="#" class="thumbnail">
      <img src="images/SNP_2922277_en_v0.png" alt="...">
    </a>
</div>

</div>
