<? $user_id=$post_data['user_id']; ?>


<script type="text/javascript">


function initialize() {
	var markers = [];

  var myLatlng = new google.maps.LatLng( <?=$post_data['lat'] ?>, <?=$post_data['lon'] ?>);
  var mapOptions = {
    zoom: 12,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map'), mapOptions);



  counter = 0;
  function updateMap(data) {
	  counter++;
	  var marker = new google.maps.Marker({
      position: new google.maps.LatLng(data.latitude,data.longitude),
	  icon:'image.php?width=40&height=40&image=/thes/photo_uploads/thumbs/<?=$post_data['profile_image'] ?>',
      map: map,
      title: 'Hello World!'
  });
  markers.push(marker);
  
  }
  

function clearOverlays() {
  for (var i = 0; i < markers.length; i++ ) {
   markers[i].setMap(null);
  }
}

// Set up the buttons

setInterval(function () {
   //Get the ID of the button that was clicked on

$.getJSON("location/view.php",{ id : <?=$user_id ?> }, function(data){
							   updateMap(data);
							   counter++;
							   });
clearOverlays();
   }, 1000 ); 	



}  

google.maps.event.addDomListener(window, 'load', initialize);


</script>
<script type="text/javascript" src="js/jquery.js"></script>
