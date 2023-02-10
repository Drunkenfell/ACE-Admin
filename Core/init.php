<?php

ob_start();
session_start();

if(strtolower($_GET["logout"])=="true"){
    $logout=true;
}

if($logout){
    unset($_SESSION["uid"]);
    unset($_SESSION["accessLevel"]);
    unset($_SESSION["timeout"]);
    
    echo 'You have cleaned session';
    header('Refresh: 2; URL = /');
    die();
}

$loadStart = date_create(date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s"));
include "config.php";
include "definitions.php";

$cleanChars = chr(34)."/abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ 0123456789',.+-*@";
include "functions.php";
$auth_required = true;

if($_POST['pwd']){
    $authInfo = getRows("ace_auth","ace_auth.account","accountName,passwordHash,accessLevel","accountName='".$_POST['uid']."'");
    $auth=password_verify($_POST['pwd'],$authInfo[0][1]);
    if($auth){
        $_SESSION['uid']=$authInfo[0][0];
        $_SESSION['uid']=$authInfo[0][0];
        $_SESSION['accessLevel']=$authInfo[0][2];
        $_SESSION['timeout'] = time();
    };

}

if($auth_required){
    if(!$_SESSION['uid']){
        ?>
    <form name=login id=login method=post>
    <table class="content" width=100% cellspacing=0 cellpadding=0 border=0>
        <tr>
            <td width=25%>&nbsp;</td>
            <td width=25%>User Id</td>
            <td width=25%><input type=text name=uid id=uid value=""></td>
            <td width=25%>&nbsp;</td>
        </tr>
        <tr>
            <td width=25%>&nbsp;</td>
            <td width=25%>Password</td>
            <td width=25%><input type=password name=pwd id=pwd value=""></td>
            <td width=25%>&nbsp;</td>
        </tr>
        <tr>
            <td width=25%>&nbsp;</td>
            <td width=50% colspan=2 align=center><input type=submit value="Go"></td>
            <td width=25%>&nbsp;</td>
        </tr>
    </table>
    </form>
        <?php
        die();
    }else{
        if( !isset($_SESSION['last_access']) || (time() - $_SESSION['last_access']) > 60 ){
            $_SESSION['last_access'] = time();
        }
    }
    if($_SESSION){
        //dump($_SESSION);
        if($_SESSION["accessLevel"]<1){
            die("You do not have access to this resource at this time.");
        }
    }
}

if(!$noStyles){
	include "styles.php";
}

?>