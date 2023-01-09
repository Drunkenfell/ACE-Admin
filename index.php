<?php
$logFolder = "Files/";
$logFiles = scandir($logFolder);
$today=date("Y-m-d", getdate()[0]);

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
$logData = array_reverse($logData);
//var_dump($logData);
?>
<html>
    <head>
        <title>ACE/Drunkenfell Home</title>
    </head>
    <body>
      <table width=100% height=100% cellpadding=0 cellspacing=2 border=1>
        <tr>
            <td colspan=8 align=center height=15>Drunkenfell Search Engine</td>
        </tr><form name="LogController" id="LogController" method="get" target=main action=logs.php>
        <tr height=15>
            <td width=12%>&nbsp;</td>
            <td width=12% align=right>SearchDate:</td>
            <td width=12%>
                <select name=SearchDate id=SearchDate>
                    <?php
                        foreach($logData as $filename => $fileDate){
                            ?><option value="<?php echo $fileDate;?>"><?php echo $fileDate;?></option>
                            <?php
                        }
                    ?>
                </select>
            </td>
            <td width=12%>&nbsp;</td>
            <td width=12% align=right>Search String:</td>
            <td width=12%><input type=text name=SearchString id=SearchString value="" width=12%></td>
            <td width=12%><a href="Files/" target=main>Log Files</a></td>
            <td width=12%><a href="weenie/weenies.php">Weenie Search</a></td>
        </tr></form>
        <tr>
            <td colspan=8><iframe height=100% width=100% name=main id=main src=""></iframe></td>
        </tr>
      </table>

    </body>
</html>
