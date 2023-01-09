<?php
  if(!$title){
  	$title = "Drunkenfell Live!";
  }
?>
<html>
<head>
  <title><?php echo $title ?></title>
	<style>
	  body{
		margin-top:1px;
		margin-left:0px;
		margin-right:0px;
		margin-bottom:0px;
		font-family:Geneva, Arial, Helvetica, sans-serif;
		
		background-color:#1A1A1A;
	  }
	  .navBar{
		background-color:#999999;
	  }
	  .navBar td{
		color:#FFFFFF;
		border-width:2px;
		border-color:#000000;
		border-style:outset;
	  }
	  .content{
		background-color:#999999;
	  }
	  .contentTitle{
		font-weight:bold;
		background-color:white;
	  }
	  .button {
		-webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
		border-radius: 5px;
	  }
	  .button:hover {
		background-color: #1F1A1A; /* Green */
		color: #FF7777;
		cursor:pointer;
	  }
	  .button a{
	    -webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
	    border-radius: 5px;
		padding: 2.5px;
		display: block;
		font-weight: bold;
		background-color:#CCCCCC;
	    color:#FFFFFF;
	  	text-decoration:none;
	  }
	  .button a:hover{
	  	background-color: #1F1A1A;
		color: red;
	  }
	  img{
		border:none;
	  }
	  a{
		text-decoration:underline;
		color:black;
	  }
	  .calendar{
	  	background-color:#999999;
	    font-family:'Arial';
	  }
	  .calendar td{
	    border-bottom-width:1px;
	  	border-style:inset;
	  }
	  .day{
	  	background-color:#999999;
		color:#EFEFEF;
		cursor:hand;
	  }
	  .day:hover{
	  	background-color:#AFAFAF;
		color:red;
	  }
	  .today{
	  	background-color:#AABBAA;
		color:#EFEFEF;
		cursor:hand;
	  }
	  .today:hover{
		background-color:#EFEFEF;
		color:#999999;
	  }
	  .MonthName{
	  	font-weight:bold;
		text-transform:uppercase;
		background-color:#FFFFFF;
	  }
	  .calHeader{
		background-color:#EFEFEF;
	  }
	</style>
</head>
<body>