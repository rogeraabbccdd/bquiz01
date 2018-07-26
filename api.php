<?php
	include_once "sql.php";
	include_once "func.php";
	
	session_start();
	$d = $_GET["do"];
	
	switch($d)
	{
		case "login":
			$result = mysqli_query($link, sql("admin", 0)." where acc = '".$_POST["acc"]."' and pass = '".$_POST["ps"]."'");
			$num = mysqli_num_rows($result);
			if($num > 0)
			{
				$row = mysqli_fetch_array($result);
				$_SESSION["user"] = $row["acc"];
				lo("admin.php");
			}
			else echo "<script>alert('帳號或密碼輸入錯誤'); window.history.back();</script>";
			break;
			
		case "logout":
			unset($_SESSION["user"]);
			lo("index.php");
			break;
			
		case "title":
			upd("title", $_POST, "");
			break;
		
		case "uptitle":
			$id = $_GET["id"];
			upfile("title", $_FILES["file"], "", $id);
			break;
		
		case "ntitle":
			mysqli_query($link, "insert into title values(null, '', '".$_POST["text"]."', 0)");
			$id = mysqli_insert_id($link);
			upfile("title", $_FILES["file"], "", $id);
			break;
			
		case "ad":
			upd("advert", $_POST, "ad");
			break;
			
		case "nad":
			mysqli_query($link, "insert into advert values(null, '".$_POST["text"]."', 1)");
			lo("admin.php?redo=ad");
			break;
			
		case "mvim":
			upd("animate", $_POST, "mvim");
			break;
			
		case "upmvim":
			$id = $_GET["id"];
			upfile("animate", $_FILES["file"], "mvim", $id);
			break;
			
		case "nmvim":
			mysqli_query($link, "insert into animate values(null, '', 1)");
			$id = mysqli_insert_id($link);
			upfile("animate", $_FILES["file"], "mvim", $id);
			break;
		
		case "image":
			upd("gallery", $_POST, "image");
			break;
			
		case "nimg":
			mysqli_query($link, "insert into gallery values(null, '', 1)");
			$id = mysqli_insert_id($link);
			upfile("gallery", $_FILES["file"], "image", $id);
			break;
			
		case "upimg":
			$id = $_GET["id"];
			upfile("gallery", $_FILES["file"], "image", $id);
			break;
			
		case "total":
			mysqli_query($link, "update visit set count = '".$_POST["count"]."'");
			lo("admin.php?redo=total");
			break;
			
		case "bottom":
			mysqli_query($link, "update footer set text = '".$_POST["text"]."'");
			lo("admin.php?redo=bottom");
			break;
			
		case "news":
			upd("news", $_POST, "news");
			break;
			
		case "nnews":
			mysqli_query($link, "insert into news values(null, '".$_POST["text"]."', 1)");
			lo("admin.php?redo=news");
			break;
			
		case "admin":
			for($i=0; $i<count($_POST["id"]); $i++)
			{
				mysqli_query($link, "update admin set acc = '".$_POST["acc"][$i]."', pass = '".$_POST["pw"][$i]."' where id = '".$_POST["id"][$i]."'");
			}
			
			foreach($_POST["del"] as $d)
			{
				mysqli_query($link, "delete from admin where id = '".$d."'");
			}
			
			lo("admin.php?redo=admin");
			break;
			
		case "nadmin":
			mysqli_query($link, "insert into admin values(null, '".$_POST["acc"]."', '".$_POST["pw"]."', '1')");
			lo("admin.php?redo=admin");
			break;
			
		case "menu":
			mysqli_query($link, "update menu set display = 0 where parent = 0");
			
			foreach($_POST["dis"] as $dis)
			{
				mysqli_query($link, "update menu set display = 1 where id = '".$dis."'");
			}
			
			for($i=0; $i<count($_POST["id"]); $i++)
			{
				mysqli_query($link, "update menu set text = '".$_POST["text"][$i]."', href = '".$_POST["href"][$i]."' where id = '".$_POST["id"][$i]."'");
			}
			
			foreach($_POST["del"] as $d)
			{
				mysqli_query($link, "delete from menu where id = '".$d."'");
			}
			
			lo("admin.php?redo=menu");
			break;
			
		case "sub":
			for($i=0; $i<count($_POST["text"]); $i++)
			{
				mysqli_query($link, "update menu set text = '".$_POST["text"][$i]."', href = '".$_POST["href"][$i]."' where id = '".$_POST["id"][$i]."'");
			}
			
			foreach($_POST["del"] as $d)
			{
				mysqli_query($link, "delete from menu where id = '".$d."'");
			}
			
			for($i=0; $i<count($_POST["text2"]); $i++)
			{
				mysqli_query($link, "insert into menu values (null, '".$_POST["text2"][$i]."', '".$_POST["href2"][$i]."', '1', '".$_GET["id"]."')");
			}
			
			foreach($_POST["del2"] as $d)
			{
				mysqli_query($link, "delete from menu where id = '".$d."'");
			}
			lo("admin.php?redo=menu");
		
		case "nmenu":
			mysqli_query($link, "insert into menu values(null, '".$_POST["text"]."', '".$_POST["href"]."', '1', '0')");
			lo("admin.php?redo=menu");
			break;		
	}
?>