

<? if(isset($_REQUEST['editabout']))
{
	
	
	
	if (isset($_POST['UpdateAbout']))
{
$gender					=	$_REQUEST['gender'];
$birthday				=	$_REQUEST['yy'].'-'.$_REQUEST['mm'].'-'.$_REQUEST['dd'];
$relationship_status	=	$_REQUEST['relationship_status'];
$current_city			=	$_REQUEST['current_city'];
$hometown				=	$_REQUEST['hometown'];
$quotes					=	$_REQUEST['quotes'];
$bio					=	$_REQUEST['bio'];


$results=$qry->queryExecute("update tsn_users set  
							gender					='".$gender."',
							birthday				='".$birthday."',
							relationship_status		='".$relationship_status."',
							current_city			='".$current_city."',
							hometown				='".$hometown."',
							bio						='".$bio."',
							quotes					='".$quotes."'
							
							where user_id='".$user_id."'");

								if(empty($_SESSION['reg_id']))
								phpredirect("u_".$user['user_name']);
								else
								phpredirect("w_edit");
}
?>



<div class="panel panel-default">
<div class="panel-heading">About Me</div><form action="a_edit" method="post" enctype="multipart/form-data" role="form">
  <div class="panel-body" id="custom-info">
    
    
    <table width="100%" class="table">
  <tr>
    <td width="18%"><strong>Basic Info</strong></td>
    <td width="82%">
<table width="100%" border="0">
      <tr>
        <td>Gender</td>
        <td><select name="gender" id="gender">
          <option <? if($user['gender']=='Male')echo "Selected"; ?> value="Male">Male</option>
          <option <? if($user['gender']=='Female')echo "Selected"; ?> value="Female">Female</option>
        </select></td>
        </tr>
      <tr>
        <td>Birthday</td>
        <td><label>
          </label>
          <table width="200" border="0">
            <tr>
              <td><select name="yy" id="yy">
              <option>Year</option>
                <? 
				$expm=explode('-',$user['birthday']); 
				for($i=date('Y');$i>=1920; $i--){ ?>
                <option <? if($expm[0]==$i) echo "selected"; ?> value="<?=$i ?>" >
                  <?=$i ?>
                  </option>
                <? } ?>
              </select></td>
              <td><select name="mm" id="mm">
              <option>Month</option>
                <option  <? if($expm[1]=='01') echo "selected"; ?>  value="01" >January</option>
                <option <? if($expm[1]=='02') echo "selected"; ?> value="02" >February</option>
                <option <? if($expm[1]=='03') echo "selected"; ?> value="03" >March</option>
                <option <? if($expm[1]=='04') echo "selected"; ?> value="04" >April</option>
                <option <? if($expm[1]=='05') echo "selected"; ?> value="05" >May</option>
                <option <? if($expm[1]=='06') echo "selected"; ?> value="06" >June</option>
                <option <? if($expm[1]=='07') echo "selected"; ?> value="07" >July</option>
                <option <? if($expm[1]=='08') echo "selected"; ?> value="08" >August</option>
                <option <? if($expm[1]=='09') echo "selected"; ?> value="09" >September</option>
                <option <? if($expm[1]=='10') echo "selected"; ?> value="10" >October</option>
                <option <? if($expm[1]=='11') echo "selected"; ?> value="11" >November</option>
                <option <? if($expm[1]=='12') echo "selected"; ?> value="12" >December</option>
              </select></td>
              <td><select name="dd" id="dd">
              <option>Day</option>
                <option <? if($expm[2]=='01') echo "selected"; ?> value="01" >1</option>
                <option <? if($expm[2]=='02') echo "selected"; ?> value="02" >2</option>
                <option <? if($expm[2]=='03') echo "selected"; ?> value="03" >3</option>
                <option <? if($expm[2]=='04') echo "selected"; ?> value="04" >4</option>
                <option <? if($expm[2]=='05') echo "selected"; ?> value="05" >5</option>
                <option <? if($expm[2]=='06') echo "selected"; ?> value="06" >6</option>
                <option <? if($expm[2]=='07') echo "selected"; ?> value="07" >7</option>
                <option <? if($expm[2]=='08') echo "selected"; ?> value="08" >8</option>
                <option <? if($expm[2]=='09') echo "selected"; ?> value="09" >9</option>
                <option <? if($expm[2]=='10') echo "selected"; ?> value="10">10</option>
                <option <? if($expm[2]=='11') echo "selected"; ?> value="11">11</option>
                <option <? if($expm[2]=='12') echo "selected"; ?> value="12">12</option>
                <option <? if($expm[2]=='13') echo "selected"; ?> value="13">13</option>
                <option <? if($expm[2]=='14') echo "selected"; ?> value="14" >14</option>
                <option <? if($expm[2]=='15') echo "selected"; ?> value="15" >15</option>
                <option <? if($expm[2]=='16') echo "selected"; ?> value="16" >16</option>
                <option <? if($expm[2]=='17') echo "selected"; ?> value="17" >17</option>
                <option <? if($expm[2]=='18') echo "selected"; ?> value="18" >18</option>
                <option <? if($expm[2]=='19') echo "selected"; ?> value="19" >19</option>
                <option <? if($expm[2]=='20') echo "selected"; ?> value="20" >20</option>
                <option <? if($expm[2]=='21') echo "selected"; ?> value="21" >21</option>
                <option <? if($expm[2]=='22') echo "selected"; ?> value="22" >22</option>
                <option <? if($expm[2]=='23') echo "selected"; ?> value="23" >23</option>
                <option <? if($expm[2]=='24') echo "selected"; ?> value="24" >24</option>
                <option <? if($expm[2]=='25') echo "selected"; ?> value="25" >25</option>
                <option <? if($expm[2]=='26') echo "selected"; ?> value="26" >26</option>
                <option <? if($expm[2]=='27') echo "selected"; ?> value="27" >27</option>
                <option <? if($expm[2]=='28') echo "selected"; ?> value="28" >28</option>
                <option <? if($expm[2]=='29') echo "selected"; ?> value="29" >29</option>
                <option <? if($expm[2]=='30') echo "selected"; ?> value="30" >30</option>
                <option value="31" >31</option>
              </select></td>
            </tr>
            </table></td>
        </tr>
      <tr>
        <td>Relationship Staus</td>
        <td><label>
          <select name="relationship_status" id="relationship_status">
            <option <? if($user['relationship_status']=='Single')echo "Selected"; ?> value="Single">Single</option>
            <option <? if($user['relationship_status']=='In a Relationship')echo "Selected"; ?> value="In a Relationship">In a Relationship</option>
          </select>
        </label></td>
        </tr>
      <tr>
        <td>Curent City</td>
        <td><strong><span class="form-group">
        <input name="current_city" type="text" class="form-control" id="exampleInputEmail1" value="<?=$user['current_city'] ?>" placeholder="Enter your current city" />
        </span></strong></td>
      </tr>
      <tr>
        <td>Hometown</td>
        <td><strong><span class="form-group">
          <input name="hometown" type="text" class="form-control" id="exampleInputEmail2" value="<?=$user['hometown'] ?>" placeholder="Enter Hometown" />
        </span></strong></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td><strong>Bio</strong></td>
    <td><span class="form-group">
    <textarea name="bio" cols="" rows="" class="form-control" id="bio"><?=$user['bio'] ?></textarea>
    </span></td>
  </tr>
  <tr>
    <td><strong>Favorite Quotations</strong></td>
    <td><span class="form-group">
      <textarea name="quotes" cols="" rows="" class="form-control" id="quotes"><?=$user['quotes'] ?></textarea>
    </span></td>
  </tr>
</table>
    



  </div>
  <div class="panel-footer"><input name="UpdateAbout" type="submit" class="btn btn-default" id="UpdateAbout"></div>    </form>
</div>

<script>
$('#dp2').datepicker();
</script>


<? }
if(isset($_REQUEST['editwork']))

{
	
	
	
	
		if (isset($_POST['AddEdu']))
{
							$name					=	trim (addslashes($_REQUEST['name']));
							$date					=	$_REQUEST['yy']."-".$_REQUEST['mm']."-01";

								   
							$qry->queryInsert("INSERT INTO  tsn_info(`name`,	`user_id`,	`info_type`,	`date_started`)
																	   VALUES ('$name',	'$user_id',	'1',		'$date')");

																	   
						
		phpredirect("w_edit");


}


if(isset($_REQUEST['del']))
{
	
	$qry->queryExecute("delete from tsn_info where info_id=".$_REQUEST['del']."");
	
phpredirect("w_edit");
}



		if (isset($_POST['AddWork']))
{
							$name					=	$_REQUEST['name'];
							$date					=	$_REQUEST['yy']."-".$_REQUEST['mm']."-01";

								   
							$qry->queryInsert("INSERT INTO  tsn_info(`name`,	`user_id`,	`info_type`,	`date_started`)
																	   VALUES ('$name',	'$user_id',	'2',		'$date')");

																	   
			if(isset($_SESSION['reg_id']))
			{
				unset($_SESSION['reg_id']);
			}	
				phpredirect("u_".$user['user_name']);
				
			
			


}

?>

<div class="panel panel-default">
<div class="panel-heading">Work and Education</div>

  <div class="panel-body" id="custom-info">
    
    
    <table width="100%" class="table">
  <tr>
    <td width="18%"><strong>Education</strong></td>
    <td width="82%">
  <form action="w_edit" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal" name="form" id="form" role="form">
    
  <table width="100%" border="0">
    <tr>
      <td>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">Institution</label>
          <div class="col-sm-5">
            <div class="form-group">
              <input name="name" type="text"   class="form-control"  id="name" />
              </div>
            </div>
          
          </div>
        <div class="form-group">
          <label for="inputPassword" class="col-sm-4 control-label">Started From</label>
          <div class="col-sm-5">
            <div class="form-group">
              <select class="form-control" name="yy" id="yy">
                <option value="0" class="form-control">Select a Year</option>
                <? for($i=date('Y');$i>1920; $i--){ ?>
                <option value="<?=$i ?>" >
                  <?=$i ?>
                  </option>
                <? } ?>
                </select>
              </div>
            <div class="form-group">
              <select  name="mm" class="form-control" id="mm">
	            <option value="00" >Select A Month</option>
                <option value="01" >January</option>
                <option value="02" >February</option>
                <option value="03" >March</option>
                <option value="04" >April</option>
                <option value="05" >May</option>
                <option value="06" >June</option>
                <option value="07" >July</option>
                <option value="08" >August</option>
                <option value="09" >September</option>
                <option value="10" >October</option>
                <option value="11" >November</option>
                <option value="12" >December</option>
                </select>
              </div>
            </div>
          </div>
        
        
        <div class="row">
          <div class="col-xs-10">
            
            </div>
          <div class="col-xs-6 form-group">
            
            </div>
          <div class="col-xs-6 form-group">
            
            </div> 
          <div class="col-xs-2 form-group">
            <input type="submit" name="AddEdu"  id="AddEdu"  class="btn btn-primary" value="Add" />
            </div>
          
          </div></td>
      </tr>
<tr>
      <td><table  class="table table-striped" width="100%" border="0">  <thead>
    <tr>
    <td width="63%"><strong>Institution </strong></td>
    <td width="26%"><strong>Year</strong></td>
    <td width="11%" align="center"><strong>Remove</strong></td>
    <td width="0%"></thead><? 		$qry_all_prod=$qry->querySelect("select *from   tsn_info where info_type=1 and user_id='".$user_id."'  order BY `date_started` desc");
			foreach($qry_all_prod as $info)
			{
				
				?> 
  <tr>    
    <td><?=$info['name'] ?></td>
    <td><? $Ym=explode('-',$info['date_started']);
			echo $Ym[0];
	?></td>
    <td align="center"><button class="btn btn-default  btn-xs" onclick="location.href='<?=baseURL ?>?p=user&editwork&del=<?=$info['info_id'] ?>';"  type="button"><span class="glyphicon glyphicon-remove"></span></button></td>
    </tr> 
  <? } ?>

  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</td>
      </tr>
    </table>
    </form>
      </td>
  </tr>
  <tr>
   
    <td width="18%"><strong>Work</strong></td>
    <td width="82%">
  <form action="w_edit" method="post" enctype="application/x-www-form-urlencoded" class="form-horizontal" name="form" id="form" role="form">
    
  <table width="100%" border="0">
    <tr>
      <td>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">Institution</label>
          <div class="col-sm-5">
            <div class="form-group">
              <input name="name" type="text"   class="form-control"  id="name" />
              </div>
            </div>
          
          </div>
        <div class="form-group">
          <label for="inputPassword" class="col-sm-4 control-label">Started From</label>
          <div class="col-sm-5">
            <div class="form-group">
              <select class="form-control" name="yy" id="yy">
                <option value="0" class="form-control">Select a Year</option>
                <? for($i=date('Y');$i>1920; $i--){ ?>
                <option value="<?=$i ?>" >
                  <?=$i ?>
                  </option>
                <? } ?>
                </select>
              </div>
            <div class="form-group">
              <select  name="mm" class="form-control" id="mm">
                <option value="00" >Select A Month</option>
                <option value="01" >January</option>
                <option value="02" >February</option>
                <option value="03" >March</option>
                <option value="04" >April</option>
                <option value="05" >May</option>
                <option value="06" >June</option>
                <option value="07" >July</option>
                <option value="08" >August</option>
                <option value="09" >September</option>
                <option value="10" >October</option>
                <option value="11" >November</option>
                <option value="12" >December</option>
                </select>
              </div>
            </div>
          </div>
        
        
        <div class="row">
          <div class="col-xs-10">
            
            </div>
          <div class="col-xs-6 form-group">
            
            </div>
          <div class="col-xs-6 form-group">
            
            </div> 
          <div class="col-xs-2 form-group">
            <input type="submit" name="AddWork"  id="AddWork"  class="btn btn-primary" value="Add" />
            </div>
          
          </div></td>
      </tr>
<tr>
      <td><table  class="table table-striped" width="100%" border="0">  <thead>
    <tr>
    <td width="63%"><strong>Institution </strong></td>
    <td width="26%"><strong>Year</strong></td>
    <td width="11%" align="center"><strong>Remove</strong></td>
    <td width="0%"></thead><? 		$qry_all_prod=$qry->querySelect("select *from   tsn_info where info_type=2 and user_id='".$user_id."'  order BY `date_started` desc");
			foreach($qry_all_prod as $info)
			{
				
				?> 
  <tr>    
    <td><?=$info['name'] ?></td>
    <td><? $Ym=explode('-',$info['date_started']);
			echo $Ym[0];
	?></td>
    <td align="center"><button class="btn btn-default  btn-xs" onclick="location.href='<?=baseURL ?>?p=user&amp;editwork&amp;del=<?=$info['info_id'] ?>';"  type="button"><span class="glyphicon glyphicon-remove"></span></button></td>
    </tr> 
  <? } ?>

  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</td>
      </tr>
    </table>
    </form>
      </td>
  </tr>

    </table>
    



  </div>
  <div class="panel-footer"></div>   
</div>

<? }
?>