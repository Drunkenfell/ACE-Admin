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
    $output['emote']=getRows("ace_world","weenie_properties_emote","*","object_Id=".$output['weenie'][0]);
    $output['genreferences']=getRows("ace_world","weenie_properties_generator","object_Id","weenie_Class_Id=".$output['weenie'][0]);
    $output['emotereferences']=getRows("ace_world","weenie_properties_emote","object_Id","weenie_Class_Id=".$output['weenie'][0]);
    //$output['emoteactionreferences']=getRows("ace_world","weenie_properties_emote_action","object_Id","weenie_Class_Id=".$output['weenie'][0]);
    $output['lbreferences']=getRows("ace_world","landblock_instance","HEX(landblock),CONCAT ('/teleloc 0x',HEX(obj_Cell_Id), ' [', origin_X,' ',origin_Y,' ',origin_Z,'] ',angles_W,' ',angles_X,' ',angles_Y,' ',angles_Z)","weenie_Class_Id=".$output['weenie'][0]);
    $output['encounterreferences']=getRows("ace_world","encounter","HEX(landblock),cell_X,Cell_Y","weenie_Class_Id=".$output['weenie'][0]);
    
    $propDir = "PropertySheets/";
    $emoteFields = explode(",","id,object_Id,category,probability,weenie_Class_Id,style,substyle,quest,vendor_Type,min_Health,max_Health");
    $eaFields=explode(",","id,emote_Id,order,type,delay,extent,motion,message,test_String,min,max,min_64,max_64,min_Dbl,max_Dbl,stat,display,amount,amount_64,hero_X_P_64,percent,spell_Id,wealth_Rating,treasure_Class,treasure_Type,p_Script,sound,destination_Type,weenie_Class_Id,stack_Size,palette,shade,try_To_Bond,obj_Cell_Id,origin_X,origin_Y,origin_Z,angles_W,angles_X,angles_Y,angles_Z");
    ?>
    <table class='content' width=33% cellpadding=2 cellspacing=2 border=1>
        <tr>
            <td colspan=4 align=left><B>Search for: <a href="http://www.drunkenfell.com/wiki/index.php?search=<?php echo $output['string'][0][1];?>" target="_blank"><?php echo $output['string'][0][1];?></a></B></td>
        </tr>
    </table>
    <?php
    foreach($output as $label => $records){
        echo PHP_EOL;
        echo "".PHP_EOL;
        if(count($records)===0){
            //break;
        }?>
        <table class='content' width=33% cellpadding=2 cellspacing=2 border=1>
            <tr>
                <td colspan=11 align=center><B><?php echo strtoupper($label);?></B></td>
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
            case 'emote':
                $eCatFile = file($propDir."emotecategory.txt");
                $eCatProps=[];
                foreach($eCatFile as $ecatLine){
                    $cat=explode("	",str_replace(chr(13).chr(10),"",$ecatLine));
                    $eCatProps[$cat[1]]=$cat[0];
                }
                $eTypeFile = file($propDir."emotetype.txt");
                $eTypeProps=[];
                foreach($eTypeFile as $eTypeLine){
                    $type=explode("	",str_replace(chr(13).chr(10),"",$eTypeLine));
                    $etypeProps[$type[1]]=$type[0];
                }
                //dump($etypeProps);
                foreach($records as $record){
                    $emoteActions=getRows("ace_world","weenie_properties_emote_action","*","emote_Id=".$record[0]);
                    echo "<tr>";
                    foreach($emoteFields as $fieldLabel){
                        echo "<td nowrap><b>".strtoupper(str_replace("_"," ",$fieldLabel))."</b></td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    foreach($record as $eFieldNum => $outputData){
                        echo "<td nowrap>";
                        switch(strtolower($emoteFields[$eFieldNum])){
                            case "weenie_class_id":
                                if($outputData!==NULL){
                                    $weenieName = getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$outputData)[0];
                                    echo $weenieName[0]." - (<a href=weenies.php?search=".$outputData." >".$outputData."</a>)";
                                }else{
                                    dump($outputData);
                                }
                                break;
                            case "category":
                                echo $eCatProps[$outputData]." (".$outputData.")";
                                break;
                            default:
                                dump($outputData);
                        }
                        echo "</td>";
                    ?>
                        
                    <?php
                    }
                    echo "<td width=100%>&nbsp;</td></tr>";
                    echo "<tr><td colspan=12><table class='content' width=33% cellpadding=2 cellspacing=2 border=1>";
                    echo "<tr>";
                    foreach($eaFields as $eaField){
                        echo "<td nowrap><B>".strtoupper(str_replace("_"," ",$eaField))."</B></td>";
                    }
                    echo "</tr>";
                    foreach($emoteActions as $emoteAction){
                        echo "<tr>";
                        foreach($emoteAction as $fieldNum => $eaOutput){
                            echo "<td nowrap>";
                            switch(strtolower($eaFields[$fieldNum])){
                                case "weenie_class_id":
                                    if($eaOutput!==NULL){
                                        $weenieName = getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$eaOutput)[0];
                                        echo $weenieName[0]." - (<a href=weenies.php?search=".$eaOutput." >".$eaOutput."</a>)";
                                    }
                                    break;
                                //case "motion":

                                //    break;
                                case "type":
                                    echo $etypeProps[$eaOutput]." (".$eaOutput.")";
                                    break;
                                default:
                                    dump($eaOutput);
                            }
                            echo "</td>";
                        }
                    }
                    echo "</tr>";
                    echo "</table>";
                }
                break;
            case 'encounterreferences':
                ?>
                <tr>
                        <td width=50%>Landblock</td>
                        <td width=50% colspan=5 nowrap>Cell</td>
                </tr>
                <?php
                foreach($records as $record){
                    ?>
                    <tr>
                        <td><?php echo $record[0]; ?></td>
                        <td colspan=5 nowrap><?php echo $record[1].",".$record[2]; ?></td>
                    <?php
                }
                    break;
            case 'emotereferences':
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
            case 'genreferences':
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