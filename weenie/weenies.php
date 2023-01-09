<?php
  include "../Core/init.php";

  $lineColors=["#cccccc","#efefef"];
  $lineCounter=0;
  
  if($_GET["search"]){
    $search=$_GET["search"];
    if(is_numeric($search)){
        $r = getRows("ace_world","weenie","*","class_Id=".$search);
      }else{
        $r = getRows("ace_world","weenie_properties_string","object_Id,value","value like '%".$search."%' and type=1 order by object_Id asc");
    }
  }
  ?><html>
    <head></head>
    <body>
        <table width=100% height=100% cellpadding=0 cellspacing=0 border=0 class="content">
          <form name="searchForm" id=searchForm action=weenies.php method=get>
            <tr height=15>
                <td width=12%></td>
                <td width=12% align=right>Search:</td>
                <td width=12%><input type=text name="search" id="search" value=""></td>
                <td width=12%></td>
                <td width=12%></td>
                <td width=12%></td>
                <td width=12%></td>
                <td width=12%></td>
            </tr>
              </form>
            <tr><td colspan=8 valign=top><?php 
                switch(count($r)){
                    case 1:
                        showDetails($r[0]);
                        break;
                    default:
                        foreach($r as $match){
                            echo $match[0]." - <a class='button' href='weenies.php?search=".$match[0]."'>".$match[1]."</a><BR>".PHP_EOL;
                        }
                }
            ?></td></tr>
        </table>
    </body>
</html>

<?php
function showDetails($weenie){
    extract($GLOBALS);
    $weenie = getRows("ace_world","weenie","*","class_Id=".$weenie[0]);
    

    $output['weenie']=$weenie[0];
    $output['string']=getRows("ace_world","weenie_properties_string","type,value","object_Id=".$output['weenie'][0]);
    $output['bool']=getRows("ace_world","weenie_properties_bool","type,value","object_Id=".$output['weenie'][0]);
    $output['float']=getRows("ace_world","weenie_properties_float","type,value","object_Id=".$output['weenie'][0]);
    $output['int']=getRows("ace_world","weenie_properties_int","type,value","object_Id=".$output['weenie'][0]);
    $output['did']=getRows("ace_world","weenie_properties_d_i_d","type,value","object_Id=".$output['weenie'][0]);

    $output['attribute']=getRows("ace_world","weenie_properties_attribute","type,init_Level,level_From_C_P,c_P_Spent","object_Id=".$output['weenie'][0]);
    $output['attribute2']=getRows("ace_world","weenie_properties_attribute_2nd","type,init_Level,level_From_C_P,c_P_Spent","object_Id=".$output['weenie'][0]);
    
    $output['iid']=getRows("ace_world","weenie_properties_i_i_d","type,value","object_Id=".$output['weenie'][0]);
    
    $output['skill']=getRows("ace_world","weenie_properties_skill","type,s_a_c,init_Level,level_From_P_P,p_p","object_Id=".$output['weenie'][0]);
    $output['int64']=getRows("ace_world","weenie_properties_int64","type,value","object_Id=".$output['weenie'][0]);
    $output['position']=getRows("ace_world","weenie_properties_position","position_Type,CONCAT ('/teleloc 0x',HEX(obj_Cell_Id), ' [', origin_X,' ',origin_Y,' ',origin_Z,'] ',angles_W,' ',angles_X,' ',angles_Y,' ',angles_Z)","object_Id=".$output['weenie'][0]);

    $output['genreferences']=getRows("ace_world","weenie_properties_generator","object_Id","weenie_Class_Id=".$output['weenie'][0]);
    $output['emotereferences']=getRows("ace_world","weenie_properties_emote","object_Id","weenie_Class_Id=".$output['weenie'][0]);
    //$output['emoteactionreferences']=getRows("ace_world","weenie_properties_emote_action","object_Id","weenie_Class_Id=".$output['weenie'][0]);
    $output['lbreferences']=getRows("ace_world","landblock_instance","HEX(landblock),CONCAT ('/teleloc 0x',HEX(obj_Cell_Id), ' [', origin_X,' ',origin_Y,' ',origin_Z,'] ',angles_W,' ',angles_X,' ',angles_Y,' ',angles_Z)","weenie_Class_Id=".$output['weenie'][0]);
    //dump($output);die();
    
    $propDir = "PropertySheets/";
    foreach($output as $label => $records){
        echo PHP_EOL;
        echo "".PHP_EOL;
        ?>
        <table class='content' width=33% cellpadding=2 cellspacing=2 border=1>
            <tr>
                <td colspan=4 align=center><?php echo $label;?></td>
            </tr>
        <?php
        $propfile = file($propDir.$label.".txt");
        $properties=[];
        foreach($propfile as $propLine){
            $prop=explode("	",$propLine);
            $properties[$prop[0]]=$prop[1];
        }
        switch(strtolower($label)){
            case 'weenie':
                $propfile = file($propDir."weenietype.txt");
                            $properties=[];
                            foreach($propfile as $propLine){
                                $prop=explode("	",$propLine);
                               $properties[$prop[0]]=$prop[1];
                            }
                            ?>
            <tr>
                    <td>WCID</td>
                    <td>Class Name</td>
                    <td>Weenie Type</td>
                    <td>Last Modified</td>
            </tr>
            <tr>
                    <td><?php echo $records[0];?></td>
                    <td><?php echo $records[1];?></td>
                    <td><?php echo "[".$records[2]."] ".$properties[$records[2]];?></td>
                    <td><?php echo $records[3];?></td>
            </tr>
                <?php
                break;
            case 'string':
                foreach($records as $record){
                    ?>
                    <tr>
                        <td><?php echo "[".$record[0]."]"; ?></td>
                        <td><?php echo $properties[$record[0]]; ?></td>
                        <td><?php 
                        switch($record[0]){
                            case 45:
                                echo "<a href='quest.php?search=".$record[1]."'>".$record[1]."</a>";
                                break;
                            case 33:
                                echo "<a href='quest.php?search=".$record[1]."'>".$record[1]."</a>";
                                break;
                            default:
                                echo $record[1];
                        } ?></td>
                    </tr>
                <?php
                }
                break;
            case 'lbreferences':
                //dump($label);
                //dump($records);
                ?>
                <tr>
                        <td>Landblock</td>
                        <td colspan=5 nowrap>Loc</td>
                </tr>
                <?php
                foreach($records as $record){
                    ?>
                    <tr>
                        <td><?php echo $record[0]; ?></td>
                        <td colspan=5 nowrap><?php echo $record[1]; ?></td>
                    <?php
                }
                break;
            case 'emotereferences':
                    //dump($label);
                    //dump($records);
                    
                    $propfile = file($propDir."weenietype.txt");
                            $properties=[];
                            foreach($propfile as $propLine){
                                $prop=explode("	",$propLine);
                               $properties[$prop[0]]=$prop[1];
                            }
                            ?>
                    <tr>
                            <td>WCID</td>
                            <td>Class Name</td>
                            <td>Weenie Type</td>
                            <td>Last Modified</td>
                    </tr><?php
                    foreach($records as $record){
                        $gen = getRows("ace_world","weenie","*","class_Id=".$record[0])[0];
                    ?>
                    <tr>
                            <td><a href="?search=<?php echo $gen[0];?>" ><?php echo $gen[0];?></a></td>
                            <td><?php echo $gen[1];?></td>
                            <td><?php echo "[".$gen[2]."] ".$properties[$gen[2]];?></td>
                            <td><?php echo $gen[3];?></td>
                    </tr>
                        <?php
                    }
                break;
                
            default:
                foreach($records as $record){
                    ?>
                    <tr>
                        <td><?php echo "[".$record[0]."]"; ?></td>
                        <td><?php echo $properties[$record[0]]; ?></td>
                        <td><?php echo $record[1]; ?></td>
                    </tr>
                <?php
                }break;
        }
        echo "</table>".PHP_EOL;
    }
}

function rowColor(){
    extract($GLOBALS);
    
    $lineCounter++;
    if(($lineCounter/2)==(floor($lineCounter/2))){
        return $lineColors[0];
    }else{
        return $lineColors[1];
    }

    return $lineCounter;
}
?>