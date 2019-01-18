<?php
	include "sql.php";
	
	switch($_GET["do"])
	{
		case "check":
			$row = Fetch(sql("admin", 0)." where acc = '".$_POST["acc"]."' and pass = '".$_POST["ps"]."'");

			$num = count($result);

			if($num > 0)
			{
				$_SESSION["a"] = $row["acc"];
				lo("admin.php");
			}
			else echo "<script>alert('帳號或密碼輸入錯誤'); window.history.back();</script>";
			break;
			
		case "out":
			unset($_SESSION["a"]);
			lo("login.php");
			break;
			
		case "title":
			upd($_POST, "title", 0);
			lo("admin.php");
			break;

		case "uptitle":
			upfile($_FILES, "title", $_GET["id"], "");
			lo("admin.php");
			break;
		
		case "ntitle":
			$nid = upd($_POST, "title", 1);
			upfile($_FILES, "title", $nid);
			lo("admin.php");
			break;
		
		case "ad":
			upd($_POST, "ad", 0);
			lo("admin.php?redo=ad");
			break;

		case "nad":
			upd($_POST, "ad", 1);
			lo("admin.php?redo=ad");
			break;
		
		case "mvim":
			upd($_POST, "mvim", 0);
			lo("admin.php?redo=mvim");
			break;

		case "nmvim":
			$nid = upd($_POST, "mvim", 1);
			upfile($_FILES, "mvim", $nid);
			lo("admin.php?redo=mvim");
			break;
		
		case "upmvim":
			upfile($_FILES, "mvim", $_GET["id"]);
			lo("admin.php?redo=mvim");
			break;

		case "image":
			upd($_POST, "image", 0);
			lo("admin.php?redo=image");
			break;
		
		case "nimage":
			$nid = upd($_POST, "image", 1);
			upfile($_FILES, "image", $nid);
			lo("admin.php?redo=image");
			break;
		
		case "upimage":
			upfile($_FILES, "image", $_GET["id"]);
			lo("admin.php?redo=image");
			break;

		case "total":
			upd($_POST, "total", 0);
			lo("admin.php?redo=total");
			break;
		
		case "bottom":
			upd($_POST, "bottom", 0);
			lo("admin.php?redo=bottom");
			break;
		
		case "news":
			upd($_POST, "news", 0);
			lo("admin.php?redo=news");
			break;
		
		case "nnews":
			upd($_POST, "news", 1);
			lo("admin.php?redo=news");
			break;

		case "admin":
			upd($_POST, "admin", 0);
			lo("admin.php?redo=admin");
			break;
		
		case "nadmin":
			upd($_POST, "admin", 1);
			lo("admin.php?redo=admin");
			break;
		
		case "menu":
			upd($_POST, "menu", 0);
			lo("admin.php?redo=menu");
			break;

		case "upmenu":
			upd($_POST, "menu", 0);
			for($i=0; $i<count($_POST["text2"]); $i++)
			{
				SQLExec("insert into menu values (null, '".$_POST["text2"][$i]."', '".$_POST["href2"][$i]."', '1', '".$_GET["id"]."')");
			}
			foreach($_POST["del2"] as $d)
			{
				SQLExec("delete from menu where id = '".$d."'");
			}
			lo("admin.php?redo=menu");
			break;

		case "nmenu":
			upd($_POST, "menu", 1);
			break;
	}
?>