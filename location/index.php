
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>

  <div id="map" style="width: 500px; height: 400px;"></div>
<? if(isset($_REQUEST['user_name']))
{
	$query = "select * from  tsn_users where user_name='".$_REQUEST['user_name']."'";
	$post_data = $qry->querySelectSingle($query);

include "location/motion.php";
?>


<? } else{ ?>
  <script type="text/javascript">
    var locations = [
		 <? 
			$k=0;
			
			$qry_all_prod=$qry->querySelect("select *from  tsn_rel where userID='$user_id' OR friendID='$user_id' order BY `rel_ID` desc");
			foreach($qry_all_prod as $friend_data)
			{  
					$theID=$friend_data['friendID'];
					if($theID==$profile_id)
					$theID=$friend_data['userID'];
			
					$query = "select * from  tsn_users where user_id='".$theID."'";
					$post_data = $qry->querySelectSingle($query);
			if(time_diff(strtotime($post_data['last_login']))<5)
		{
					?>['<?=$post_data['full_name'] ?>', <?=$post_data['lat'] ?>, <?=$post_data['lon'] ?>, <?=++$k ?>,'image.php?width=40&height=40&image=/thes/photo_uploads/thumbs/<?=$post_data['profile_image'] ?>'],
			  <?  }
	} 

	
 ?>

      ['<?=$user['full_name'] ?>', <?=$user['lat'] ?>, <?=$user['lon'] ?>, <?=++$k ?>,'image.php?width=40&height=40&image=/thes/photo_uploads/thumbs/<?=$user['profile_image'] ?>']
    ];
	

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: new google.maps.LatLng(<?=$user['lat'] ?>, <?=$user['lon'] ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
		icon: locations[i][4],
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
<? } ?>