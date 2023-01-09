<?php
  include "../Core/init.php";
  if($_GET["search"]){
    $output['questinfo']=getRows("ace_world","quest","*","name='".$_GET["search"]."'")[0];
    $emaSearch=getRows("ace_world","weenie_properties_emote_action","emote_Id","message like'%".$_GET["search"]."%'");
    
    foreach($emaSearch as $order => $item){
        $output['emoteactioninfo'][$order] = $item[0];
    }
    $output['emoteinfo']=getRows("ace_world","weenie_properties_emote","object_Id","id in (".implode(",",$output['emoteactioninfo']).")");
    $npcList = [];
    foreach($output['emoteinfo'] as $order => $npc){
        if(!in_array($npc[0],$npcList)){
            array_push($npcList,$npc[0]);
        }   
    }
  }

  //dump($npcList);
?>
    <table class="content" width=33% cellpadding=0 cellspacing=0 border=1>
        <tr>
            <td colspan=4 align=center>Quest Information</td>
        </tr>
        <tr>
            <td>Quest Name</td>
            <td>Min Delta</td>
            <td>Max Solves</td>
            <td>Message</td>
        </tr>
        <tr>
            <td><?php echo $output['questinfo'][1];?></td>
            <td><?php echo $output['questinfo'][2];?></td>
            <td><?php echo $output['questinfo'][3];?></td>
            <td><?php echo $output['questinfo'][4];?></td>
        </tr>
        <tr>
            <td colspan=4 align=center>Associated NPC(s)</td>
        </tr>
        <?php
        foreach($npcList as $npc){
            $npcInfo = getRows("ace_world","weenie_properties_string","value","type=1 and object_Id='".$npc."'")[0];
            ?>
        <tr>
            <td colspan=4><a href="weenies.php?search=<?php echo $npc;?>"><?php echo $npc;?></a> <?php echo $npcInfo[0];?></td>
        </tr>

            <?php
        }
        ?>
    </table>
