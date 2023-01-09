<?php
$Base64="/A+B9C8D7E6F5G4H3I2J1K0LzMyNxOwPvQuRtSsTrUqVpWoXnYmZlakbjcidhegf-";

function compress($string){
	return gzdeflate($string,9);
}

function expand($encodedString){
	return gzinflate($encodedString);
}

function cleanCrypt($tmp){
	$validChars = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ=+/.";
	$output="";
	$x=0;
	
	while($x<=strlen($tmp)){
		if(strstr($validChars,substr($tmp,$x,1))){
			$output.=substr($tmp,$x,1);
		}
		$x++;
	}
	return $output;
}

function Decode($base64String)
{
  extract($GLOBALS);
  $crypt = new EncryptDecrypt;
  
  $base64String = cleanCrypt($crypt->encrypt_decrypt("decrypt",$base64String));
  
//response.Write base64String & "<BR>"
  if (!$base64String=="")
  {

//rfc1521
//1999 Antonin Foller, Motobit Software, http://Motobit.cz
    $Base64="/A+B9C8D7E6F5G4H3I2J1K0LzMyNxOwPvQuRtSsTrUqVpWoXnYmZlakbjcidhegf-";

//remove white spaces, If any

    $base64String=str_replace("\r\n","",$base64String);
    $base64String=str_replace("\t","",$base64String);
    $base64String=str_replace(" ","",$base64String);

//The source must consists from groups with Len of 4 chars
    $dataLength=strlen($base64String);
	//echo "datalength = $dataLength <BR />";
    if ($dataLength%4!=0)
    {
		//echo "Bad String<BR />";
//Err.Raise 1, "Base64Decode", "Bad Base64 string."
      $function_ret=$base64String;
      return cleanCrypt($function_ret);
	} 
	$sOut = "";
// Now decode each group:
    for ($groupBegin=1; $groupBegin<=$dataLength; $groupBegin=$groupBegin+4)
    {// Each data group encodes up To 3 actual bytes.
      $numDataBytes=3;
      $nGroup=0;
	  //echo "groupBegin = $groupBegin <BR />";
      for ($CharCounter=0; $CharCounter<=3; $CharCounter+=1)
      {
// Convert each character into 6 bits of data, And add it To
// an integer For temporary storage.  If a character is a '=', there
// is one fewer data byte.  (There can only be a maximum of 2 '=' In
// the whole string.)
		
        $thisChar=substr($base64String,$groupBegin+$CharCounter-1,1);
		
        if ($thisChar=="=" || $thisChar=="/")
        {
          $numDataBytes=$numDataBytes-1;
          $thisData=0;
        }
          else
        {
          //echo "thisChar = $thisChar | ";
		  //echo "CharCounter = $CharCounter <BR />";
		  $thisData=(strpos($Base64,$thisChar,1) ? strpos($Base64,$thisChar,1)+1 : 0)-1;
        } 
        if ($thisData==-1)
        {
          return cleanCrypt($function_ret);
        } 
        $nGroup=64*$nGroup+$thisData;
      }
	  //echo "nGroup = $nGroup <BR />";
	  //Hex splits the long To 6 groups with 4 bits
      $nGroup=base_convert($nGroup,10,16);
	  //Add leading zeros
      $nGroup=str_repeat("0",6-strlen($nGroup)).$nGroup;
	  //Convert the 3 byte hex integer (6 chars) To 3 characters
	  $fromBase = 16;
	  $toBase = 10;
	  
	  $part1=substr($nGroup,0,2);
	  $part2=substr($nGroup,2,2);
	  $part3=substr($nGroup,4,2);
	  //echo "part1 = $part1 Part2 = $part2  Part3 = $part3 <BR />";
	  
	  $part1=base_convert($part1,$fromBase,$toBase);
	  $part2=base_convert($part2,$fromBase,$toBase);
	  $part3=base_convert($part3,$fromBase,$toBase);
	  
	  //echo "part1 = $part1 Part2 = $part2  Part3 = $part3 <BR />";
	  
	  $pOut=chr($part1).chr($part2).chr($part3);
	  
	  //echo "pOut = $pOut <BR />";
	  
	  //add numDataBytes characters To out string
	  $sOut.=$pOut;
	  //echo "sOut = $sOut <BR />";
    }
    $function_ret=$sOut;
//response.Write Base64Decode & "<BR>"
  } 
  	
  return cleanCrypt($function_ret);
}  

function Encode($inData)
{
  extract($GLOBALS);

//rfc1521
//2001 Antonin Foller, Motobit Software, http://Motobit.cz
  $Base64="/A+B9C8D7E6F5G4H3I2J1K0LzMyNxOwPvQuRtSsTrUqVpWoXnYmZlakbjcidhegf-";

//For each group of 3 bytes
  for ($I=1; $I<=strlen($inData); $I=$I+3)
  {
//Create one long from this 3 bytes.
    $nGroup=0x10000*ord(substr($inData,$I-1,1))+
      0x100*MyASC(substr($inData,$I+1-1,1))+MyASC(substr($inData,$I+2-1,1));
	//echo "nGroup = $nGroup <BR />";
//Oct splits the long To 8 groups with 3 bits
    $nGroup=base_convert($nGroup,10,8);
	//echo "nGroup2 = $nGroup <BR />";

//Add leading zeros
    $nGroup=str_repeat("0",8-strlen($nGroup)).$nGroup;
	//echo "nGroup3 = $nGroup <BR />";

//Convert To base64
    $pOut=substr($Base64,intval(base_convert(substr($nGroup,0,2),8,10))+1-1,1).
      substr($Base64,intval(base_convert(substr($nGroup,2,2),8,10))+1-1,1).
      substr($Base64,intval(base_convert(substr($nGroup,4,2),8,10))+1-1,1).
      substr($Base64,intval(base_convert(substr($nGroup,6,2),8,10))+1-1,1);
	//echo "pOut = $pOut <BR />";
//Add the part To OutPut string
    $sOut=$sOut.$pOut;

//Add a new line For Each 76 chars In dest (76*3/4 = 57)
//If (I + 2) Mod 57 = 0 Then sOut = sOut + vbCrLf

  }//echo "sOut = $sOut <BR /><BR />";

  switch (strlen($inData)%3)
  {
    case 1:
//8 bit final
      $sOut=substr($sOut,0,strlen($sOut)-2)."==";
      break;
    case 2:
//16 bit final
      $sOut=substr($sOut,0,strlen($sOut)-1)."=";
      break;
  } 
  if(substr($sOut,strlen($sOut)-2,2)=="//"){
  	$sOut = substr($sOut,0,strlen($sOut)-2)."==";
  }
  
  $crypt = new EncryptDecrypt;
  $function_ret=$sOut;
  return $crypt->encrypt_decrypt("encrypt",$function_ret);
} 

function MyASC($OneChar)
{
  extract($GLOBALS);

  if ($OneChar=="")
  {
    $function_ret=0;
  }
    else
  {
    $function_ret=ord($OneChar);
  } 
  return $function_ret;
} 

//zEwt @ TechMeOut.TV
//EncryptDecrypt Class + Function
class EncryptDecrypt
{
    public function encrypt_decrypt($action, $string) {
        $output = false;
        $key = md5('salt');
        $iv = md5(md5($key));
            if( $action == 'encrypt' ) {
                $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
                $output = base64_encode($output);
				return $output;
            }
            else if( $action == 'decrypt' ){
                $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
                $output = rtrim($output, "");
				return cleanCrypt($output);
            }
    
    
    }
}

//Usage Example
?>