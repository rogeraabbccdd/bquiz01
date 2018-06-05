<?php
	/*** 開啟資料庫連接 ***/
	$link = mysqli_connect("localhost", "root", "", "dbxx");
	
	/*** 設定UTF8 ***/
	mysqli_query($link, "set names utf8");
	
	/*** BANNER ***/
	$result = mysqli_query($link, "select * from title where display = 1");
	while($row = mysqli_fetch_array($result))
	{
		$title_pic = $row["file"];
		$title_text = $row["text"];
	}	
	
	/*** 廣告輪播 ***/
	$advert = "";
	$result = mysqli_query($link, "select * from advert where display = 1");
	while($row = mysqli_fetch_array($result))
	{
		$advert .= $row["text"].", ";
	}
	
	/*** 頁尾版權 ***/
	$result = mysqli_query($link, "select * from footer");
	while($row = mysqli_fetch_array($result))
	{
		$footer = $row["text"];
	}
	
	/*** 圖片輪播 ***/
	$ani = "";
	$result = mysqli_query($link, "select * from animate where display = 1");
	while($row = mysqli_fetch_array($result))
	{
		$ani .= "'./img/".$row["file"]."',";
	}
	
	/*** 訪客人數 ***/
	$result = mysqli_query($link, "select * from visit");
	while($row = mysqli_fetch_array($result))
	{
		$visit = $row["count"];
	}
	
	/*** 校園映像 ***/
	$num = 0;
	$gallery = "<div onclick='pp(1)' align='center'><img src='./img/01E01.jpg'></div>";
	$result = mysqli_query($link, "select * from gallery where display = 1");
	$gallery_num = mysqli_num_rows($result);
	while($row = mysqli_fetch_array($result))
	{
		$gallery .= "
		<img src='./img/".$row["file"]."' style='width:150px; height='103px' align='center' class='im' id='ssaa".$num."' />
		";
		
		$num++;
	}
	$gallery .= "<div onclick='pp(2)' align='center'><img src='./img/01E02.jpg'></div>";
	
	/*** 主選單 ***/
	$menu = "";
	// 先取主選單
	$result = mysqli_query($link, "select * from menu where parent = 0");
	while($row = mysqli_fetch_array($result))
	{
		$menu .= "<div class='mainmu' align='center'>
							<a href='".$row["href"]."' align='center'>".$row["text"]."</a>";
		
		// 再取次選單
		$result2 = mysqli_query($link, "select * from menu where parent = ".$row["id"]."");
		while($row2 = mysqli_fetch_array($result2))
		{		
			$menu .= "<div class='mainmu2 mw' align='center' style='display:none'>
							<a href='".$row2["href"]."' align='center'>".$row2["text"]."</a>
					</div>";
		}
							
		$menu .= "</div>";
	}
?>