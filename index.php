<?php

include "Core/init.php";

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
      <table class="content" width=100% height=100% cellpadding=0 cellspacing=2 border=1>
        <tr>
            <td colspan=8 align=center height=15><?php echo $siteTitle;?></td>
        </tr>
        <tr height=10>
          <td colspan=3 align=center> Log Search</td>
          <td>&nbsp;</td>
          <td colspan=2 align=center> Weenie Search</td>
          <td>Spell Search</td>
          <td>&nbsp;</td>

        </tr>
        <tr height=15>
        <form name="LogController" id="LogController" method="get" target=main action=logs.php>
            <td width=12% align=right>LogDate:<select name=SearchDate id=SearchDate>
                    <?php
                        foreach($logData as $filename => $fileDate){
                            ?><option value="<?php echo $fileDate;?>"><?php echo $fileDate;?></option>
                            <?php
                        }
                    ?>
                </select></td>
            <td width=12% align=right>Log String:</td>
            <td width=12%><input type=text name=SearchString id=SearchString value="" width=12%></td></form>
            <td width=12%>&nbsp;</td>
            <td width=12% align=right>&nbsp;</td>
            <form name="wcidSearch" id="wcidSearch" method="get" target=main action="weenie/weenies.php">
              <td width=12%><input type=text name=search id=search value=""></td></form>
            <form name="spellSearch" id="spellSearch" method="get" target=main action="weenie/spells.php">
              <td width=12%><input type=text name=SearchString id=SearchString value=""></td>
            </form>
            <td width=12%><a href="Files/" target=main>Log Files</a></td>
        </tr>
        <tr>
            <td colspan=8><iframe height=100% width=100% name=main id=main src=""></iframe></td>
        </tr>
      </table>

    </body>
</html>
