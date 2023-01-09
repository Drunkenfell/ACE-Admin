<?php

$logFolder = "Files/";
$logFiles = scandir($logFolder);
$today=date("Y-m-d", getdate()[0]);
//var_dump($today);

if($_GET["SearchDate"]){
    $searchDate = $_GET["SearchDate"];
}else{
    $searchDate = $today;
}


$logData = [];
foreach ($logFiles as $fNum => $fName){
    switch($fName){
        case ".":
            break;
        case "..":
            break;
        case "Archive":
            break;
        default:
            $fileDate = str_replace("ACE_Log-","",str_replace(".log","",$fName));
            $logData[$fName]=$fileDate;
    }
    
}

foreach($logData as $file => $logDate){
    if($logDate==$searchDate){
        $logContents = array_reverse(file($logFolder.$file));
    }
}


?><pre><?php
$logType=explode(" ",$_GET["SearchString"]);
foreach($logContents as $line){
    $match=[];
    foreach($logType as $itemNum => $searchStr){
        if(strpos(strtolower($line),strtolower($searchStr))){
            //echo $line;
            $match[$itemNum]=true;
        }else{
            $match[$itemNum]=false;
        }
    }
    //var_dump($match);
    $decision=true;
    foreach($match as $criteria){
        //var_dump($criteria);
        if($criteria===false){
            $decision=false;
        }
    }
    //var_dump($decision);
    if($decision===true){
        echo $line;
    }
}
//var_dump(array_reverse($logContents));
?></pre>