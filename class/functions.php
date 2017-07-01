<? define("baseURL", "http://localhost/thes/");

function time_diff($timestamp)
{
	 //type cast, current time, difference in timestamps
    $timestamp      = (int) $timestamp;
    $current_time   = time();
    $diff           = $current_time - ($timestamp);
	return ($diff);
	
}

if(isset($_GET['logout']))
{
	session_destroy();
	phpredirect("index.php");
}	

if(isset($_SESSION['user_name']))
{
	$query = "select * from  tsn_users where unique_id='".$_SESSION['unique_id']."'";
	$user = $qry->querySelectSingle($query);
	$user_id=$user['user_id'];
	$numrows=sizeof($qry->querySelect($query));
	if($numrows==0)
	{
		session_destroy();
		phpredirect("index.php");
	}
	
	
	if(isset($_GET['location']))
	{
		$loc=($_GET['location']+1)%2;
		mysql_query("UPDATE  tsn_users SET location='$loc' WHERE user_id ='$user_id'");
							
								phpredirect(baseURL.'?');
	}
	
	
	
}

     function percent($num_amount, $num_total) {
        $count1 = $num_amount / ($num_total+0.1);
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);
        return $count;
    }
	

?>
<? 

function time_passed($timestamp){
	 //type cast, current time, difference in timestamps
    $timestamp      = (int) $timestamp;
    $current_time   = time();
    $diff           = $current_time - $timestamp;
   
    //intervals in seconds
    $intervals      = array (
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
    );
   
    //now we just find the difference
    if ($diff <= 0)
    {
        return 'Just Now';
    }   

    if ($diff < 60 && $diff > 0)
    {
        return 'Few  seconds ago';
    }       

    if ($diff >= 60 && $diff < $intervals['hour'])
    {
        $diff = floor($diff/$intervals['minute']);
        return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
    }       

    if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
    {
        $diff = floor($diff/$intervals['hour']);
        return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
    }   

    if ($diff >= $intervals['day'] && $diff < $intervals['week'])
    {
        $diff = floor($diff/$intervals['day']);
        return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
    }   

    if ($diff >= $intervals['week'] && $diff < $intervals['month'])
    {
        $diff = floor($diff/$intervals['week']);
        return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
    }   

    if ($diff >= $intervals['month'] && $diff < $intervals['year'])
    {
        $diff = floor($diff/$intervals['month']);
        return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
    }   

    if ($diff >= $intervals['year'])
    {
        $diff = floor($diff/$intervals['year']);
        return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
    }
}

function theNotify($p_id,$from_id,$to_id)
{
			if($to_id!=$from_id){
		//1. wallpost 2. Comment_post 3. Like
		$qry->queryInsert("INSERT INTO  tsn_notification(`p_id` ,`type_id`,`from_id`,`to_id`)
		VALUES ('".$p_id."','1','$user_id','$to_id') ");
		}
}

function parseSmiley($text){
    // Smiley to image
    $smileys = array(
        '^_^' => '01',
        ':D' => '02',
        ':)' => '03',
		';)' => '04',
		'8D' => '06',
		'8)' => '07',
		':P' => '08',
		':8' => '09',
		':O' => '10',
		':(' => '12',
		'>:(' => '13',
		'3:)' => '14'
    );

    // Now you need find and replace
    foreach($smileys as $smiley => $img){
        $text = str_replace(    
            $smiley,
            "<img src='emoticons/icontexto-emoticons-{$img}-016x016.png' />",
            $text
        );
    }

    // Now only return it
    return $text;
}
?>