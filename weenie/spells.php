<div class="Content"><?php
  include "../Core/init.php";
  
  $fieldNames="id,name,stat_Mod_Type,stat_Mod_key,stat_Mod_Val,e_type,base_Intensity,variance,wcid,num_Projectiles,num_Projectiles_Variance,spread_Angle,vertical_Angle,default_Launch_Angle,non_Tracking,create_Offset_Origin_X,create_Offset_Origin_Y,create_Offset_Origin_Z,padding_Origin_X,padding_Origin_Y,padding_Origin_Z,dims_Origin_X,dims_Origin_Y,dims_Origin_Z,peturbation_Origin_X,peturbation_Origin_Y,Peturbation_Origin_Z,imbued_Effect,slayer_Creature_Type,slayer_Damage_Bonus,crit_Freq,crit_Multiplier,ignore_Magic_Resist,elemental_Modifier,drain_Percentage,damage_Ratio,damage_Type,boost,boost_Variance,source,destination,proportion,loss_Percent,source_Loss,transfer_Cap,max_Boost_Allowed,transfer_Bitfield,index,link,position_Obj_Cell_ID,position_Origin_X,position_Origin_Y,position_Origin_Z,position_Angles_W,position_Angles_X,position_Angles_Y,position_Angles_Z,min_Power,max_Power,power_Variance,dispel_School,align,number,number_Variance,dot_Duration,last_Modified";
  $fieldNames = explode(",",$fieldNames);


  if($_GET["SearchString"]){
    $output['spellInfo']=getRows("ace_world","spell","*","name like '%".$_GET["SearchString"]."%'");
    //$output['books']=getRows("ace_world","weenie_properties_spell_book","emote_Id","message like'%".$output['spellInfo'][0]."%'");
    foreach($output['spellInfo'] as $spell){
      echo "<a href='?id=".$spell[0]."'>".$spell[0]."</a> - ". $spell[1]."<BR />".PHP_EOL;
    }
  }

  if($_GET["id"]){
    $output['spellInfo']=getRows("ace_world","spell","*","id=".$_GET["id"]);
    $output['books']=getRows("ace_world","weenie_properties_spell_book","*","spell = ".$output['spellInfo'][0][0]);
    foreach($output['spellInfo'] as $spell){
      foreach($spell as $fieldNum => $spellNfo){
        switch($fieldNum){
            default:
              echo $fieldNames[$fieldNum].": ".$spell[$fieldNum]."<BR />".PHP_EOL;
        }
      }
    }
    dump($output["books"]);
    //dump($output['spellInfo'][0]);
  }

  
  
?></div>