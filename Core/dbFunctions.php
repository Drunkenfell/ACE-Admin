<?php

function listTable($tableName){
    extract($GLOBALS);
    $viewData = getRows($iA,$_GET["view"]);
    $bgColors=["#FFFFFF","#999999"]
    ?>
    <table class="content" width=100% border=0 cellpadding=0 cellspacing=0>
        <tr>
            <td colspan=20 align=center>
                <table class="contentTitle" width=100% cellpadding=0 cellspacing=0 border=0>
                    <tr>
                        <td width=10%>&nbsp;</td>
                        <td width=80% align=center><?php echo strtoupper(str_replace("_"," ",$tableName));?></td>
                        <td width=10% align=right><a class="button" href="?view=<?php echo $_GET['view'];?>&mode=add"><img src="Images/newfile.gif" title="New Record" /></a></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
    <?php
    foreach($schema[$_GET["view"]] as $key => $fieldLabel){
    echo "<td><strong>".str_replace("_"," ",strtoupper($fieldLabel))."</strong></td>";
    }
    echo "</tr>";
    foreach($viewData as $key => $rowValues){
        if(is_int($key/2)){
            $rowColor=$bgColors[0];
        }else{
            $rowColor=$bgColors[1];
        }
        ?><tr class="button" onclick="javascript:document.location.href='?view=<?php echo $tableName;?>&edit=<?php echo $rowValues[0];?>';" style="background-color:<?php echo $rowColor;?>">
        <?php
        foreach($rowValues as $columnKey => $columnValue){
            echo "<td>".$columnValue."</td>";
        }
    }
}

function editRecord($tableName,$recordID){
    extract($GLOBALS);
    $recordData = getRows($iA,$tableName,NULL,"id=".$recordID)[0];
    
    ?>
    <table class="content" width=100% border=0 cellpadding=0 cellspacing=0>
      <form name="recordEditor" id="recordEditor" method="post">
        <?php
        foreach($recordData as $key => $field){
            switch($schema[$tableName][$key]){
                case "id":
                    break;
                default:
        ?>
        <tr>
            <td width=15%><?php echo $schema[$tableName][$key];?></td>
            <td><input name="<?php echo $schema[$tableName][$key];?>" id="<?php echo $schema[$tableName][$key];?>" type="text" value="<?php echo $recordData[$key];?>"></td>
        </tr>
        <?php
            break;
            }
        }
        ?>
        <tr><td align=right><input type=submit value="Save"></td><td></td></tr>
      </form>
    </table>
    <?php
}

function addRecord($tableName){
    extract($GLOBALS);
    //$recordData = getRows($iA,$tableName,NULL,"id=".$recordID)[0];
    
    ?>
    <table class="content" width=100% border=0 cellpadding=0 cellspacing=0>
      <form name="recordEditor" id="recordEditor" method="post">
        <?php
        foreach($schema[$tableName] as $key => $field){
            switch($schema[$tableName][$key]){
                case "id":
                    break;
                default:
        ?>
        <tr>
            <td width=15%><?php echo $schema[$tableName][$key];?></td>
            <td><input name="<?php echo $schema[$tableName][$key];?>" id="<?php echo $schema[$tableName][$key];?>" type="text" value=""></td>
        </tr>
        <?php
            break;
            }
        }
        ?>
        <tr><td align=right><input type=submit value="Save"></td><td></td></tr>
      </form>
    </table>
    <?php
}

function saveInfo(){
    extract($GLOBALS);
    if($_GET['edit']){
        updateRow($iA,$_GET['view'],array_keys($_POST),array_values($_POST),"id=".$_GET['edit']);
        unset($_GET['edit']);
    }else{
        addRow($iA,$_GET['view'],array_keys($_POST),array_values($_POST));
    }
    dump("Record Saved.");
}

function getTasks($date){
    if($date){
        $tasks=getRows($IA,"tasks","*","date LIKE '".$date."%'");
        return $tasks;
    }
}
?>