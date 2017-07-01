


<?php

    $user_ip = $user_id;
    $pageID = $prod['p_id']; // The ID of the page, the article or the video ...

    //function to calculate the percent


    // check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
        $dislike_sql = mysql_query('SELECT COUNT(*) FROM  tsn_rate WHERE user_id = "'.$user_ip.'" and p_id = "'.$pageID.'" and  post_type= "'.$post_type.'" and rate = 2 ');
        $dislike_count = mysql_result($dislike_sql, 0); 

        $like_sql = mysql_query('SELECT COUNT(*) FROM  tsn_rate WHERE user_id = "'.$user_ip.'" and p_id = "'.$pageID.'" and  post_type= "'.$post_type.'" and rate = 1 ');
        $like_count = mysql_result($like_sql, 0);  

        // count all the rate 
        $rate_all_count = mysql_query('SELECT COUNT(*) FROM  tsn_rate WHERE p_id = "'.$pageID.'" and  post_type= "'.$post_type.'"');
        $rate_all_count = mysql_result($rate_all_count, 0);  

        $rate_like_count = mysql_query('SELECT COUNT(*) FROM  tsn_rate WHERE p_id = "'.$pageID.'"  and  post_type= "'.$post_type.'" and rate = 1');
        $rate_like_count = mysql_result($rate_like_count, 0);  
        $rate_like_percent = percent($rate_like_count, $rate_all_count);

        $rate_dislike_count = mysql_query('SELECT COUNT(*) FROM  tsn_rate WHERE p_id = "'.$pageID.'" and rate = 2');
        $rate_dislike_count = mysql_result($rate_dislike_count, 0);  
        $rate_dislike_percent = percent($rate_dislike_count, $rate_all_count);
?>

<script>
    $(function(){ 
        var pageID = <?php echo $pageID;  ?>; 

        $('.my-like-btn<?php echo $pageID;  ?>').click(function(){
            $('.my-dislike-btn<?php echo $pageID;  ?>').removeClass('dislike-h');    
            $(this).addClass('like-h');
            $.ajax({
                type:"POST",
                url:"ajax/ajax-like.php",
                data:'act=like&pageID='+pageID+'&user_id=<?php echo $user_id;  ?>&post_type=<?php echo $post_type;  ?>',
                success: function(){
                }
            });
        });
        $('.my-dislike-btn<?php echo $pageID;  ?>').click(function(){
            $('.my-like-btn<?php echo $pageID;  ?>').removeClass('like-h');
            $(this).addClass('dislike-h');
            $.ajax({
                type:"POST",
                url:"ajax/ajax-like.php",
                data:'act=dislike&pageID='+pageID+'&user_id=<?php echo $user_id;  ?>&post_type=<?php echo $post_type;  ?>',
                success: function(){
                }
            });
        });
        $('.share-btn').click(function(){
            $('.share-cnt').toggle();
        });
    });
</script>


<div style="display:inline-block; width:100%; border-bottom:#ccc solid 1px; margin-bottom:20px; padding-bottom:10px;">
            <div class="my-like-btn<?php echo $pageID;  ?> like-btn <?php if($like_count == 1){ echo 'like-h';} ?>">Like</div>
  <div class="my-dislike-btn<?php echo $pageID;  ?> dislike-btn <?php if($dislike_count == 1){ echo 'dislike-h';} ?>"></div>
            <div class="stat-cnt">
             <!-- <div class="rate-count"><?php echo $rate_all_count; ?></div>
                <div class="stat-bar">
                    <div class="bg-green" style="width:<?php echo $rate_like_percent; ?>%;"></div>
                    <div class="bg-red" style="width:<?php echo $rate_dislike_percent; ?>%"></div>
                </div> stat-bar -->
                <div style="margin-bottom:10px;"></div>
                <div class="glyphicon glyphicon-thumbs-up  btn-xs"> <?php echo $rate_like_count; ?> &nbsp;</div>
                <div class="glyphicon glyphicon-thumbs-down  btn-xs"> <?php echo $rate_dislike_count; ?></div>
  </div></div><!-- /stat-cnt -->
