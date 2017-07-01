<?php 
/********************www.xyz.com********************************/
/*					      By Sumit Bajracharya                                   */
/*						Email:xxx@hotmail.com                   		*/
/********************Connection Class***************************************/
define("dbhost","localhost",true);
define("uname","root",true);
define("password","",true);
define("dbname","db_thesocialnetwork",true);

//connection class
class database{
	
	var $link;
	
	function  database($dbhost,$uname,$password, $dbname){
		
		$this->link=@mysql_connect($dbhost,$uname,$password) or die("Error:=>Could not connect");
		
		mysql_select_db($dbname,$this->link);//
		
	}//enf of function
	
}//enf of class

$db = new database(dbhost,uname,password,dbname);
?>