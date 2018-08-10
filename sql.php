<?php
	include_once "func.php";
	
	$link = mysqli_connect("localhost", "root", "", "dbxx");
	mysqli_query($link, "set names utf8");
	
	$result = mysqli_query($link, sql("title", 1));
	$row = mysqli_fetch_array($result);
	$title = $row["file"];
	$title_text = $row["text"];
	
	$footer = mysqli_fetch_array(mysqli_query($link, sql("footer", 0)))["text"];
	
	$ani = "";
	$result = mysqli_query($link, sql("animate", 1));
	while($row = mysqli_fetch_array($result))
	{
		$ani .= "'img/".$row["file"]."',";
	}
	
	$gallery = "<img src='img/01E01.jpg' onclick='pp(1)'><br>";
	$i = 0;
	$result = mysqli_query($link, sql("gallery", 1));
	$gnum = mysqli_num_rows($result);
	while($row = mysqli_fetch_array($result))
	{
		$gallery .= "<img src='img/".$row["file"]."' class='im' id='ssaa".$i."' width='150' height='103'>";
		$i++;
	}
	$gallery .= "<br><img src='img/01E02.jpg' onclick='pp(2)'>";
	
	$visit = mysqli_fetch_array(mysqli_query($link, sql("visit", 0)))["count"];
	
	$menu = "";
	$result = mysqli_query($link, sql("menu", 1)." and parent = 0");
	while($row = mysqli_fetch_array($result))
	{
		$menu .= "<div class='mainmu'><a href='".$row["href"]."'>".$row["text"]."</a>";
		
		$result2 = mysqli_query($link, sql("menu", 1)." and parent = '".$row["id"]."'");
		while($row2 = mysqli_fetch_array($result2))
		{
			$menu .= "<div class='mainmu2 mw'><a href='".$row2["href"]."' class='mainmu2 mw'>".$row2["text"]."</a></div>";
		}
		
		$menu .= "</div>";
	}
	
	$mar = "";
	$result = mysqli_query($link, sql("advert", 1));
	while($row = mysqli_fetch_array($result))
	{
		$mar .= $row["text"]."&emsp;";
	}
	
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