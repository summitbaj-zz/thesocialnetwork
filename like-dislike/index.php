
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


<?php
    include 'config.php';
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $pageID = '33'; // The ID of the page, the article or the video ...

    //function to calculate the percent
    function percent($num_amount, $num_total) {
        $count1 = $num_amount / ($num_total+0.1);
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);
        return $count;
    }

    // check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
        $dislike_sql = mysql_query('SELECT COUNT(*) FROM  tsn_rate WHERE user_id = "'.$user_ip.'" and p_id = "'.$pageID.'" and rate = 2 ');
        $dislike_count = mysql_result($dislike_sql, 0); 

        $like_sql = mysql_query('SELECT COUNT(*) FROM  tsn_rate WHERE user_id = "'.$user_ip.'" and p_id = "'.$pageID.'" and rate = 1 ');
        $like_count = mysql_result($like_sql, 0);  

        // count all the rate 
        $rate_all_count = mysql_query('SELECT COUNT(*) FROM  tsn_rate WHERE p_id = "'.$pageID.'"');
        $rate_all_count = mysql_result($rate_all_count, 0);  

        $rate_like_count = mysql_query('SELECT COUNT(*) FROM  tsn_rate WHERE p_id = "'.$pageID.'" and rate = 1');
        $rate_like_count = mysql_result($rate_like_count, 0);  
        $rate_like_percent = percent($rate_like_count, $rate_all_count);

        $rate_dislike_count = mysql_query('SELECT COUNT(*) FROM  tsn_rate WHERE p_id = "'.$pageID.'" and rate = 2');
        $rate_dislike_count = mysql_result($rate_dislike_count, 0);  
        $rate_dislike_percent = percent($rate_dislike_count, $rate_all_count);
?>

<script>
    $(function(){ 
        var pageID = <?php echo $pageID;  ?>; 

        $('.like-btn').click(function(){
            $('.dislike-btn').removeClass('dislike-h');    
            $(this).addClass('like-h');
            $.ajax({
                type:"POST",
                url:"ajax.php",
                data:'act=like&pageID='+pageID,
                success: function(){
                }
            });
        });
        $('.dislike-btn').click(function(){
            $('.like-btn').removeClass('like-h');
            $(this).addClass('dislike-h');
            $.ajax({
                type:"POST",
                url:"ajax.php",
                data:'act=dislike&pageID='+pageID,
                success: function(){
                }
            });
        });
        $('.share-btn').click(function(){
            $('.share-cnt').toggle();
        });
    });
</script>



            <div class="like-btn <?php if($like_count == 1){ echo 'like-h';} ?>">Like</div>
  <div class="dislike-btn <?php if($dislike_count == 1){ echo 'dislike-h';} ?>"></div>
            <div class="stat-cnt">
              <div class="rate-count"><?php echo $rate_all_count; ?></div>
                <div class="stat-bar">
                    <div class="bg-green" style="width:<?php echo $rate_like_percent; ?>%;"></div>
                    <div class="bg-red" style="width:<?php echo $rate_dislike_percent; ?>%"></div>
                </div><!-- stat-bar -->
                <div class="dislike-count"><?php echo $rate_dislike_count; ?></div>
                <div class="like-count"><?php echo $rate_like_count; ?></div>
  </div><!-- /stat-cnt -->
