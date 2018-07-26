<?php
	include_once "func.php";
	include_once "sql.php";
	
	session_start();
	
	if(empty($_SESSION["visit"]))
	{
		$_SESSION["visit"] = "123";
		mysqli_query($link, "update visit set count = count + 1");
		$visit++;
	}
	
	if(empty($_SESSION["user"]))
	{
		$btn = "管理登入";
		$btnlink = "login.php";
	}
	else
	{
		$btn = "回後台管理";
		$btnlink = "admin.php";
	}
?>