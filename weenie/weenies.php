<?php
$siteTitle = "Drunkenfell WCID lookup!";
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
    $propDir = "PropertySheets/";
    
    $propfile = file($propDir."emotecategory.txt");
    $eCatProps=[];
    foreach($propfile as $ecatLine){
        $cat=explode("	",str_replace(chr(13).chr(10),"",$ecatLine));
        $eCatProps[$cat[1]]=$cat[0];
    }
    $propfile = file($propDir."emotetype.txt");
    $eTypeProps=[];
    foreach($propfile as $eTypeLine){
        $type=explode("	",str_replace(chr(13).chr(10),"",$eTypeLine));
        $etypeProps[$type[1]]=$type[0];
    }
    $propfile = file($propDir."motion.txt");
    $motionProps=[];
    foreach($propfile as $motionLine){
        $motion=explode("	",str_replace(chr(13).chr(10),"",$motionLine));
        $motionProps[$motion[1]]=$motion[0];
    }
    $propfile = file($propDir."destinationtype.txt");
    $destProps=[];
    foreach($propfile as $destLine){
        $dest=explode("	",str_replace(chr(13).chr(10),"",$destLine));
        $destProps[$dest[1]]=$dest[0];
    }
    $propfile = file($propDir."weenietype.txt");
    $weenieTypes=[];
    foreach($propfile as $propLine){
        $prop=explode("	",$propLine);
        $weenieTypes[$prop[0]]=$prop[1];
    }
    $propfile = file($propDir."skill.txt");
    $skills=[];
    foreach($propfile as $propLine){
        $prop=explode("	",$propLine);
        $skills[$prop[0]]=$prop[1];
    }
    
    $emoteFields = ["id","object_Id","category","probability","weenie_Class_Id","style","substyle","quest","vendor_Type","min_Health","max_Health"];
    $eaFields=["id","emote_Id","order","type","delay","extent","motion","message","test_String","min","max","min_64","max_64","min_Dbl","max_Dbl","stat","display","amount","amount_64","hero_X_P_64","percent","spell_Id","wealth_Rating","treasure_Class","treasure_Type","p_Script","sound","destination_Type","weenie_Class_Id","stack_Size","palette","shade","try_To_Bond","obj_Cell_Id","origin_X","origin_Y","origin_Z","angles_W","angles_X","angles_Y","angles_Z"];
    $createFields = ["id","object_Id","destination_Type","weenie_Class_Id","stack_Size","palette","shade","try_To_Bond"];
    $recipe_ref_Fields = ["id","skill","difficulty","success_W_C_I_D","success_Message","success_Amount","fail_Message","fail_Amount"];
    $cookbook_Fields=["source_W_C_I_D","target_W_C_I_D","recipe_Id"];
    $generatorFields=["id","object_Id","probability","weenie_Class_Id","delay","init_Create","max_Create","when_Create","where_Create","stack_Size","palette_Id","shade","obj_Cell_Id","origin_X","origin_Y","origin_Z","angles_W","angles_X","angles_Y","angles_Z"];
    $skillFields=["type","s_a_c","init_Level","level_From_P_P","p_p","init_Level"];
    $spellbookFields=["spell","probability"];

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
    $output['skill']=getRows("ace_world","weenie_properties_skill",implode(",",$skillFields),"object_Id=".$output['weenie'][0]);
    $output['spellbook']=getRows("ace_world","weenie_properties_spell_book",implode(",",$spellbookFields),"object_Id=".$output['weenie'][0]);
    $output['int64']=getRows("ace_world","weenie_properties_int64","type,value","object_Id=".$output['weenie'][0]);
    $output['position']=getRows("ace_world","weenie_properties_position","position_Type,CONCAT ('/teleloc 0x',HEX(obj_Cell_Id), ' [', origin_X,' ',origin_Y,' ',origin_Z,'] ',angles_W,' ',angles_X,' ',angles_Y,' ',angles_Z)","object_Id=".$output['weenie'][0]);
    $output['emote']=getRows("ace_world","weenie_properties_emote","*","object_Id=".$output['weenie'][0]);
    $output['genreferences']=getRows("ace_world","weenie_properties_generator","object_Id","weenie_Class_Id=".$output['weenie'][0]);
    $output['emotereferences']=getRows("ace_world","weenie_properties_emote","object_Id","weenie_Class_Id=".$output['weenie'][0]);
    $output['create_list']=getRows("ace_world","weenie_properties_create_list",implode(",",$createFields),"object_Id=".$output['weenie'][0]);
    $output['create_ref']=getRows("ace_world","weenie_properties_create_list",implode(",",$createFields),"weenie_Class_Id=".$output['weenie'][0]);
    $output['lbreferences']=getRows("ace_world","landblock_instance","HEX(landblock),CONCAT ('/teleloc 0x',HEX(obj_Cell_Id), ' [', origin_X,' ',origin_Y,' ',origin_Z,'] ',angles_W,' ',angles_X,' ',angles_Y,' ',angles_Z)","weenie_Class_Id=".$output['weenie'][0]);
    $output['encounterreferences']=getRows("ace_world","encounter","HEX(landblock),cell_X,Cell_Y","weenie_Class_Id=".$output['weenie'][0]);
    $output['recipe_ref']=getRows("ace_world","recipe",implode(",",$recipe_ref_Fields),"success_W_C_I_D=".$output['weenie'][0]);
    $output['recipe_ingredient']=getRows("ace_world","cook_book",implode(",",$cookbook_Fields),"source_W_C_I_D=".$output['weenie'][0]." OR target_W_C_I_D=".$output['weenie'][0]);

    $output['generator']=getRows("ace_world","weenie_properties_generator","*","object_Id=".$output['weenie'][0]);
    //var_dump($output['recipe_ingredient']);die();
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
      if(count($records)>0){
        
        ?>
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
            case "spellbook":
                echo "<tr>";
                foreach($spellbookFields as $fieldLabel){
                    echo "<td nowrap><b>".strtoupper(str_replace("_"," ",$fieldLabel))."</b></td>";
                }
                echo "</tr>";
                foreach($records as $record){
                    echo "<tr>";
                    foreach($record as $order => $field){
                        echo "<td nowrap>";
                        if($field){
                            switch(strtolower($spellbookFields[$order])){
                                case "spell":
                                    $spellInfo=getRows("ace_world","spell","id,name","id=".$field)[0];
                                    echo "<a href=spells.php?id=".$field.">".$spellInfo[1]."</a>";
                                    break;
                                default:
                                    echo $field;
                            }
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                break;
            case "skill":
               echo "<tr>";
                foreach($skillFields as $fieldLabel){
                    echo "<td nowrap><b>".strtoupper(str_replace("_"," ",$fieldLabel))."</b></td>";
                }
                echo "</tr>";
                foreach($records as $record){
                    echo "<tr>";
                    foreach($record as $order => $field){
                        echo "<td nowrap>";
                        if($field){
                            switch(strtolower($skillFields[$order])){
                                case "type":
                                    echo $properties[$record[0]]." - ".$field;
                                    break;
                                default:
                                    echo $field;
                            }
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                break;
            case "generator":
                echo "<tr>";
                foreach($generatorFields as $fieldLabel){
                    echo "<td nowrap><b>".strtoupper(str_replace("_"," ",$fieldLabel))."</b></td>";
                }
                echo "</tr>";
                foreach($records as $record){
                    echo "<tr>";
                    foreach($record as $order => $field){
                        echo "<td nowrap>";
                        if($field){
                            switch(strtolower($generatorFields[$order])){
                                case "weenie_class_id":
                                    $weenieName=getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$field)[0][0]." - (<a href=weenies.php?search=".$field.">".$field.")";
                                    echo $weenieName;
                                    break;
                                default:
                                    echo $field;
                            }
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                
                
                break;
            case "recipe_ref":
                
                echo "<tr><td nowrap><B>SOURCE</B></td><td nowrap><B>TARGET</B></td>";
                foreach($recipe_ref_Fields as $fieldLabel){
                    echo "<td nowrap><b>".strtoupper(str_replace("_"," ",$fieldLabel))."</b></td>";
                }
                echo "</tr>";
                
                
                foreach($records as $record){
                    //var_dump($cookbook_Fields);die();
                    echo "<tr>";
                    $cookbook = getRows("ace_world","cook_book",implode(",",$cookbook_Fields),"recipe_Id=".$record[0])[0];
                    $source=getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$cookbook[0])[0][0]." - (<a href=weenies.php?search=".$cookbook[0].">".$cookbook[0].")";
                    $target=getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$cookbook[1])[0][0]." - (<a href=weenies.php?search=".$cookbook[1].">".$cookbook[1].")";
                    //var_dump($cookbook);die();
                    echo "<td nowrap>".$source."</td><td nowrap>".$target."</td>";
                    
                    foreach($record as $order => $field){
                        echo "<td nowrap>";
                        if($field){
                            switch(strtolower($recipe_ref_Fields[$order])){
                                case "success_w_c_i_d":
                                    $success=$field;
                                    $success=getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$field)[0][0]." - (<a href=weenies.php?search=".$field.">".$field.")";
                                    echo $success;
                                    break;
                                case "skill":
                                    echo $skills[$field]." - (".$field.")";
                                    break;
                                default:
                                echo $field;
                            }
                        }
                        echo "</td>";
                    }
                    
                    echo "</tr>";
                }
                
                
                break;
                case "recipe_ingredient":
                    //$recipe_ref_Fields = ["id","skill","success_W_C_I_D","success_Message","success_Amount","fail_Message","fail_Amount"];
                    //$cookbook_Fields=["source_W_C_I_D","target_W_C_I_D","recipe_Id"];
                
                    echo "<tr><td nowrap><B>SOURCE</B></td><td nowrap><B>TARGET</B></td>";
                    foreach($recipe_ref_Fields as $fieldLabel){
                        echo "<td nowrap><b>".strtoupper(str_replace("_"," ",$fieldLabel))."</b></td>";
                    }
                    echo "</tr>";
                    
                    
                    foreach($records as $record){
                        $source=$record[0];
                        $target=$record[1];
                        $source=getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$record[0])[0][0]." - (<a href=weenies.php?search=".$record[0].">".$record[0].")";
                        $target=getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$record[1])[0][0]." - (<a href=weenies.php?search=".$record[1].">".$record[1].")";
                        $recipe = getRows("ace_world","recipe",implode(",",$recipe_ref_Fields),"id=".$record[2])[0];
                        //dump($record);
                        //foreach($record as $field){
                            echo "<tr>";
                            echo "<td nowrap>".$source."</td><td nowrap>".$target."</td>";
                            
                            //dump($recipe);
                            foreach($recipe as $order => $rField){
                                echo "<td nowrap>";
                                if($rField){
                                    
                                    switch(strtolower($recipe_ref_Fields[$order])){
                                        case "success_w_c_i_d":
                                            $success=$field;
                                            $success=getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$rField)[0][0]." - (<a href=weenies.php?search=".$rField.">".$rField.")";
                                            echo $success;
                                            break;
                                        case "skill":
                                            echo $skills[$rField]." - (".$rField.")";
                                            break;
                                        default:
                                        echo $rField;
                                    }
                                }
                                echo "</td>";
                            }
                        //}
                        echo "</tr>";
                    }
                    break;
            case 'weenie':
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
                    <td><?php echo "[".$records[2]."] ".$weenieTypes[$records[2]];?></td>
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
                            if($eaOutput){
                                switch(strtolower($eaFields[$fieldNum])){
                                    case "weenie_class_id":
                                        $weenieName = getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$eaOutput)[0];
                                        echo $weenieName[0]." - (<a href=weenies.php?search=".$eaOutput." >".$eaOutput."</a>)";
                                        break;
                                    case "motion":
                                        echo $motionProps["0x".dechex($eaOutput)]." (".$eaOutput.")";
                                        break;
                                    case "type":
                                        echo $etypeProps[$eaOutput]." (".$eaOutput.")";
                                        break;
                                    default:
                                        dump($eaOutput);
                                }
                            }
                            echo "</td>";
                        }
                    }
                    echo "</tr>";
                    echo "</table>";
                }
                break;
            case 'create_list':
                echo "<tr>";
                foreach($createFields as $fieldLabel){
                    echo "<td nowrap><b>".strtoupper(str_replace("_"," ",$fieldLabel))."</b></td>";
                }
                echo "</tr>";
                
                foreach($records as $record){
                    echo "<tr>";
                    foreach($record as $order => $field){
                        echo "<td nowrap>";
                        if($field){
                            switch(strtolower($createFields[$order])){
                                case "destination_type":
                                    echo $destProps[$field]." - (".$field.")";
                                    break;
                                case "weenie_class_id":
                                    $weenieName = getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$field)[0];
                                    echo $weenieName[0]." - (<a href=weenies.php?search=".$field." >".$field."</a>)";
                                    break;
                                default:
                                    echo $field;
                            }
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                
                //dump($records);
                break;
            case 'create_ref':
                echo "<tr>";
                foreach($createFields as $fieldLabel){
                    echo "<td nowrap><b>".strtoupper(str_replace("_"," ",$fieldLabel))."</b></td>";
                }
                echo "</tr>";
                
                foreach($records as $record){
                    echo "<tr>";
                    foreach($record as $order => $field){
                        echo "<td nowrap>";
                        if($field){
                            switch(strtolower($createFields[$order])){
                                case "object_id":
                                    $weenieName = getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$field)[0];
                                    echo $weenieName[0]." - (<a href=weenies.php?search=".$field." >".$field."</a>)";
                                    break;
                                case "destination_type":
                                    echo $destProps[$field]." - (".$field.")";
                                    break;
                                case "weenie_class_id":
                                    $weenieName = getRows("ace_world","weenie_properties_string","value","type=1 and object_Id=".$field)[0];
                                    echo $weenieName[0]." - (<a href=weenies.php?search=".$field." >".$field."</a>)";
                                    break;
                                default:
                                    echo $field;
                            }
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                
                //dump($records);
                
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
                        <td><?php echo "[".$gen[2]."] ".$weenieTypes[$gen[2]];?></td>
                        <td><?php echo $gen[3];?></td>
                </tr>
                    <?php
                }
                break;
            case 'genreferences':
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
                            <td><?php echo "[".$gen[2]."] ".$weenieTypes[$gen[2]];?></td>
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
                        <td><?php 
                            switch(strtolower($properties[$record[0]])){
                                case "spell":
                                    $spellInfo=getRows("ace_world","spell","id,name","id=".$record[1])[0];
                                    echo "<a href=spells.php?id=".$record[1].">".$spellInfo[1]."</a>";
                                    break;
                                default:
                                echo $record[1]; 
                            }
                            
                            
                        ?></td>
                    </tr>
                <?php
                }break;
        }
        echo "</table>".PHP_EOL;
      }
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