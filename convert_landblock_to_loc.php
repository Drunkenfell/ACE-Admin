<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Landblock Calculator</title>
<style>
.result{
	font-style:italic;
	margin:1em 0;	
}
</style>	
</head>

<body>
<p>Enter a landblock value (e.g. 0xAAB4000A) to get the map coordinates (e.g. 42.2N 34.3E)</p>
<?php

//convert_landblock('0x03FB000C');//99.2N, 99.4W
//convert_landblock('7F7F001C');
//convert_landblock('0x00FE0008');
$hex = "";
if(isset($_POST['hex'])){
	$hex = $_POST['hex'];
	$hex = str_replace('0x', '', $hex); //remove the 0x bit
	if(strlen($hex)==4){
		convert_quadblock($hex);
	}else{
		convert_landblock($hex);	
	}
}


/*
convert_quadblock('17B2');
convert_quadblock('1748');
convert_landblock('0xB5F00116');
convert_quadblock('B5F0');
*/
?>
<form method="post">

<input type="text" name="hex" value="<?php echo $hex;?>"> <input type="submit" value="Convert Landblock">
</form>

<p>Enter a coordinate pair to generate the landblock (42.2N, 34.3E)</p>
<?php

$raw_coords = "";
if(isset($_POST['coord'])){
	$raw_coords = trim($_POST['coord']);
	$coords = strtolower($raw_coords);
	// remove any comma
	$coords = str_replace(',', '', $coords);
	
	$coord_pair = explode(' ', $coords);
	preg_match_all('!\d+(?:\.\d+)?!', $coords, $matches);
	$floats = array_map('floatval', $matches[0]);

	if(count($coord_pair) > 1 && count($floats) > 1){
		
		// North/South value
		if(strpos($coord_pair[0], 'n') !== false){
			$ns_pair = $floats[0] - 0.5;
		}else{
			$ns_pair = ($floats[0] * -1) - 0.5;
		}
		$ns_pair = round($ns_pair * 10 + 0x400);
		
		// East/West value
		if(strpos($coord_pair[1], 'e') !== false){
			$ew_pair = $floats[1] - 0.5;
		}else{
			$ew_pair = ($floats[1] * -1) - 0.5;
		}
		$ew_pair = round($ew_pair * 10 + 0x400);
		
		$blockX = ($ns_pair >> 3);
		$blockY = ($ew_pair >> 3);
		$cellX = ($ns_pair & 7);
		$cellY = ($ew_pair & 7);

		$block = dechex(($blockY << 8) | $blockX);
		$cell = dechex(($cellX << 3) | $cellY);

		while(strlen($block) < 4){
			$block = '0'.$block;
		}
		while(strlen($cell) < 4){
			$cell = '0'.$cell;
		}
			
		echo '<div class="result">';
		echo $raw_coords .' => 0x'.strtoupper($block).strtoupper($cell);
		echo '</div>';
	}
	
	
}
?>

<form method="post">

<input type="text" name="coord" value="<?php echo $raw_coords;?>"> <input type="submit" value="Convert Coordinates">
</form>

<?php
/*
    Your location is: 0x09040008 [11.400000 188.600006 87.521667] -0.996345 0.000000 0.000000 -0.085417
    The landblock is 0904
    The next part, "0008", identifies which square in the 8x8 grid you are standing in. When this value is >= 0x0100 you are inside (either in a building or in a dungeon).
    The next three values are your x, y, and z positions within the landblock. In a dungeon, they are the x, y, z position inside the entire dungeon.
    The last four values are a quaternion representing your orientation. (I think it is w, x, y, z). 
*/	

function convert_quadblock($hex){
	convert_landblock('0x'.$hex.'0000');	
	
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
	//debug::out($landblock_hex, 'landblock_hex');
	
	$landblock_x = hexdec(substr($landblock_hex, 0,2)) + 1;
	$landblock_y = hexdec(substr($landblock_hex, 2,2)) + 1;
	
	
	$rough_x = get_coord($landblock_x, 'x');
	$rough_y = get_coord($landblock_y, 'y');
	
//	debug::out($landblock_x, 'landblock_x');
//	debug::out($landblock_y, 'landblock_y');
	//debug::out($rough_y, 'rough_y');
	//debug::out($rough_x, 'rough_x');
	
	echo '<div class="result">';
	echo $hex.' => '.$rough_y.' '.$rough_x.'<br>';	
	echo '</div>';
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
</body>
</html>