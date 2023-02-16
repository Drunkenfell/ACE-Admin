<?php 
  function getRows($connectionTxt,$table,$fields,$condition){
	extract($GLOBALS);
	$mysqli = new mysqli($dbAddress,$dbUser,$dbPass,$DB);

	// Check connection
	if ($mysqli -> connect_errno) {
	echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	exit();
	}
	if(!$fields){
		$fields='*';
	}
	$sql = "SELECT ".$fields." FROM ".$table;
	if($condition){
		$sql.=" WHERE ".$condition;
	}
	//dump($sql);
	if ($result = $mysqli -> query($sql)) {
		$rows = [];
		while ($row = $result -> fetch_row()) {
		  array_push($rows,$row);
		}
		
	  }
	  $mysqli -> close();
	  return $rows;
  }
  
  function addRow($connectionTxt,$table,$fields,$values){
    extract($GLOBALS);
	$connection = new mysqli($dbAddress,$dbUser,$dbPass,$DB);
    if(!$connection){
		dump("Add Failed - ".$connection);
		if($connection->connect_error){
		  die("Connection Failed.");
		}
		
		//exit("DB Connection Failed: " . $connection);
	};//else{echo "DB Connection Established";};
    //$fieldsAr=explode(",",$fields);
	//$valAr = explode(",",$values);
	if(!is_array($fields)){
		//$fields;
		//$values;
	}else{
		$fieldAr = [];
		foreach($fields as $field){
			array_push($fieldAr,"`".trim($field)."`");
		}
		$fields = implode(",",$fieldAr);
		
		$valAr = [];
		foreach($values as $value){
			if(is_bool($value)){
				array_push($valAr,$value);
			}else{
				array_push($valAr,'"'.$value.'"');
			}
			
		}
		$values = implode(",",$valAr);
	}
	
	$qryString = 'INSERT INTO '.$table.' ('.$fields.') VALUES ('.$values.');';
	//if($debug){
		//dump($qryString);
		//die();
	//}
	
	$result = $connection -> query($qryString);
	
	$errMsg = $result;
	if($errMsg){
		//dump($qryString);
		//dump($errMsg);
		return false;
	}else{
		return true;
	}
  }

  function updateRow($connection,$table,$fields,$values,$condition){
	extract($GLOBALS);$errMsg=false;
	$connection = new mysqli($dbAddress,$dbUser,$dbPass,$DB);
    //$connection = odbc_connect($connection,'','');
	if(!$connection){
		dump("Connection Failed - ".$connection);
		return false;
	};//else{echo "DB Connection Established";};
    if(is_array($fields)){
		//$fieldsAr=explode(",",$fields);
		//$valAr = explode(",",$values);
		$fieldsAr=$fields;
		$valAr = $values;
	}else{
		$fieldsAr=explode(",",$fields);
		$valAr = explode(",",$values);
		$fieldsAr[0]=$fields;
		$valAr[0]=$values;
	}
	$prepString = "";
	
	for($Field=0;$Field<count($fieldsAr);$Field++){
	  $prepString.= "`".$fieldsAr[$Field]."`='".trim($valAr[$Field])."'";
	  if($Field!=count($fieldsAr)-1){
	    $prepString.=",";
	  }
	}
	
	$qryString = "UPDATE ".$table." SET ".$prepString;
	$qryString.=" WHERE ".$condition;
	
	//dump($qryString);
	//die();
	$result = $connection -> query($qryString);
	if($debug){
		echo "<br>";
		echo $qryString."<BR />";
		echo "<br>";
		//die();
	}
	//die();
	//odbc_close($connection);
	return $result;
  }
  
  function getFields($connection,$table){
	extract($GLOBALS);$errMsg=false;
  	$connection = odbc_connect($connection,'','');
	if(!$connection){
		dump("Query Failed - ".$connection);
		return false;
		//exit("DB Connection Failed: " . $connection);
	};//else{echo "DB Connection Established";};
    
	$rs = odbc_columns($connection,'', 'Inventory',$table,'');
	$rows = array();
	
	while($row = odbc_fetch_array($rs)){
	  $rowData= $row;
	  array_push($rows,$rowData);
	}
	//odbc_close($connection);
	$errMsg = odbc_errormsg($connection);
	if($debug){
		echo "<br>";
		echo $qryString."<BR />";
		var_dump($rows);
		echo "<br><br>";
		//die();
	}
	if($errMsg){
		//dump($qryString);
		//dump($errMsg);
		return false;
	}else{
		if(count($rows)>0){
			return $rows;
		}else{
			return false;
		}
	}
  }
  
  function getTables($connection,$schematxt){
	extract($GLOBALS);$errMsg=false;
  	$connection = odbc_connect($connection,'','');
	if(!$connection){
		dump("Query Failed - ".$connection);
		return false;
		//exit("DB Connection Failed: " . $connection);
	};//else{echo "DB Connection Established";};
    
	$qryString = "SHOW TABLES FROM ".$schematxt;
	
	//echo $qryString."<BR />";//die();
	$rs=odbc_exec($connection,$qryString);
	if(!$rs){echo("Error in SQL: ".$qryString);}
	//$rows = odbc_fetch_array($rs);
	
	$rows = array();
	$fieldsAr=explode(",",$fields);
	
	while($row = odbc_fetch_array($rs)){
	  $rowData= $row;
	  array_push($rows,$rowData);
	}
	//odbc_close($connection);
	$errMsg = odbc_errormsg($connection);
	if($debug){
		echo "<br>";
		echo $qryString."<BR />";
		var_dump($rows);
		echo "<br><br>";
		//die();
	}
	if($errMsg){
		//dump($qryString);
		//dump($errMsg);
		return false;
	}else{
		if(count($rows)>0){
			return $rows;
		}else{
			return false;
		}
	}
  }
  
  function deleteRows($connection,$table,$condition){
	extract($GLOBALS);$errMsg=false;
  	$connection = odbc_connect($connection,'','');
    if(!$connection){
		dump("Delete Failed - ".$connection);
		return false;
		//exit("DB Connection Failed: " . $connection);
	};//else{echo "DB Connection Established";};
    //$fieldsAr=explode(",",$fields);
	//$valAr = explode(",",$values);
	$fieldsAr=$fields;
	$valAr = $values;
	
	$qryString = 'DELETE FROM '.$table.' WHERE '.$condition;
	
	//echo $qryString."<BR /><BR />";//die();
	$rs=odbc_exec($connection,$qryString);
	if($debug){
		echo "<br>";
		echo $qryString."<BR />";
		echo "<br>";
		//die();
	}
	//odbc_close($connection);
	return true;
  }
?>