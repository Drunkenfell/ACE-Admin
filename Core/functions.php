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

function convert_landblock($hex){
	
	$landblocks = 256;
	
	$hex = str_replace('0x', '', $hex);
	if(strlen($hex) < 8){
		echo 'Invalid Hex String';
		return false;	
	}
	// 0000 is the lower left corner. So ffff should be top right.
	$landblock_hex = substr($hex, 0,4);
	
	$landblock_x = hexdec(substr($landblock_hex, 0,2)) + 1;
	$landblock_y = hexdec(substr($landblock_hex, 2,2)) + 1;
	
	
	$rough_x = get_coord($landblock_x, 'x');
	$rough_y = get_coord($landblock_y, 'y');
	
	
	return $rough_y.' '.$rough_x;	
	
}

function get_coord($block, $dir){
	if($block == 128){ return "0"; }
	if($block > 128){
		$coord = ($block - 128) / 128 * 102;
		
		$coord = number_format($coord, 1);
		
		switch($dir){
			case "x":
				$coord.= 'E';
				break;
			case "y":
				$coord.= 'N';
				break;
		}
		return($coord);
		//negative values			
	}else{
		$coord = (128 - $block) / 128 * 102;

		$coord = number_format($coord, 1);

		switch($dir){
			case "x":
				$coord.= 'W';
				break;
			case "y":
				$coord.= 'S';
				break;
		}
		return($coord);
		//positive values
	}
}
?>