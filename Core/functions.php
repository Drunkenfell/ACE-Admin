<?php

include "phpmysql.php";
//include "crypt.php";
//include "dbFunctions.php";

function dump($variable){
  //extract($GLOBALS);
  global $debug;
  if(!$debug){
	//if(!$noStyles){
		echo "<pre>";
	//}
	if(is_array($variable)){
		var_dump($variable);
	}else{
		echo($variable);
	}
	//if(!$noStyles){
		echo "</pre>".PHP_EOL;
	//}
  }
}

?>