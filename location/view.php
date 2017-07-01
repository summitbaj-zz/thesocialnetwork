<?php
header('Content-Type: application/json');

$path='';
include $path."../class/db_connect.class.php";
include $path."../class/sqlQuery.class.php";




    

	$user_id=$_GET['id'];
    $query = "select * from  tsn_users where user_id=".$user_id."";
    $ligne = $qry->querySelectSingle($query);


     


    $data = array(
    
        'latitude'           => $ligne["lat"],
		'longitude'            => $ligne["lon"]
		
		);

    mysql_close();

 echo (json_encode($data));
?>