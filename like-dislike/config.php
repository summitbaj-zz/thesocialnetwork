<?php 
 $mysql_host = "localhost";
 $mysql_database = "db_thesocialnetwork";
 $mysql_user = "root";
 $mysql_password = "";

 $db = mysql_connect($mysql_host,$mysql_user,$mysql_password);
 mysql_connect($mysql_host,$mysql_user,$mysql_password);
 mysql_select_db($mysql_database);
?>