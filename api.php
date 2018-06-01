<?php
	include "sql.php";
	
	$from = $_GET["from"];
	if($from == "titleupload")
	{
		$filename = strtotime("now");
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$filename .= ".".$ext;
		copy($_FILES["file"]["tmp_name"], "./img/".$filename);
		mysqli_query($link, "insert into title values(null, '".$filename."', '".$_POST["text"]."', 0)");
		header("location:admin.php");
	}
	elseif($from == "titleupdate")
	{
		$filename = strtotime("now");
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$filename .= ".".$ext;
		copy($_FILES["file"]["tmp_name"], "./img/".$filename);
		mysqli_query($link, "update titles set file = '".$filename."' where id = '".$_GET["id"]."'");
		header("location:admin.php");
	}
	elseif($from == "title")
	{
		$delete = $_POST["delete"];
		
		foreach($delete as $del_id)
		{
			mysqli_query($link, "delete from title where id = '".$del_id."'");
		}
		
		$display = $_POST["display"];
		mysqli_query($link, "update title set display = 0");
		mysqli_query($link, "update title set display = 1 where id = '".$display."'");
		header("location:admin.php");
	}
	elseif($from == "advertadd")
	{
		$ad = $_POST["text"];
		mysqli_query($link, "insert into advert values(null, '".$ad."', 1)");
		header("location:admin.php?redo=ad");
	}
	elseif($from == "advert")
	{
		for($i = 0; $i < count($_POST["id"]); $i++)
		{
			if(!empty($_POST["delete".$_POST["id"][$i]]))
				mysqli_query($link, "delete from advert where id = '".$_POST["id"][$i]."'");
			
			else
			{
				if(!empty($_POST["display".$_POST["id"][$i]]))
					mysqli_query($link, "update advert set text = '".$_POST["text"][$i]."' , display = 1 where id = '".$_POST["id"][$i]."'");
				else
					mysqli_query($link, "update advert set text = '".$_POST["text"][$i]."' , display = 0 where id = '".$_POST["id"][$i]."'");
			}
		}
		header("location:admin.php?redo=ad");
	}
	elseif($from == "mvimupload")
	{
		$filename = strtotime("now");
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$filename .= ".".$ext;
		copy($_FILES["file"]["tmp_name"], "./img/".$filename);
		mysqli_query($link, "insert into animate values(null, '".$filename."', 1)");
		header("location:admin.php?redo=mvim");
	}
	elseif($from == "mvimupdate")
	{
		$filename = strtotime("now");
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$filename .= ".".$ext;
		copy($_FILES["file"]["tmp_name"], "./img/".$filename);
		mysqli_query($link, "update titles set file = '".$filename."' where id = '".$_GET["id"]."'");
		header("location:admin.php?redo=mvim");
	}
	elseif($from == "mvim")
	{
		for($i = 0; $i < count($_POST["id"]); $i++)
		{
			if(!empty($_POST["delete".$_POST["id"][$i]]))
				mysqli_query($link, "delete from animate where id = '".$_POST["id"][$i]."'");
			
			else
			{
				if(!empty($_POST["display".$_POST["id"][$i]]))
					mysqli_query($link, "update animate set display = 1 where id = '".$_POST["id"][$i]."'");
				else
					mysqli_query($link, "update animate set display = 0 where id = '".$_POST["id"][$i]."'");
			}
		}
		header("location:admin.php?redo=mvim");
	}
	elseif($from == "imageupload")
	{
		$filename = strtotime("now");
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$filename .= ".".$ext;
		copy($_FILES["file"]["tmp_name"], "./img/".$filename);
		mysqli_query($link, "insert into gallery values(null, '".$filename."', 1)");
		header("location:admin.php?redo=image");
	}
	elseif($from == "imageupdate")
	{
			$filename = strtotime("now");
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$filename .= ".".$ext;
		copy($_FILES["file"]["tmp_name"], "./img/".$filename);
		mysqli_query($link, "update gallery set file = '".$filename."' where id = '".$_GET["id"]."'");
		header("location:admin.php?redo=image");
	}
	elseif($from == "image")
	{
		for($i = 0; $i < count($_POST["id"]); $i++)
		{
			if(!empty($_POST["delete".$_POST["id"][$i]]))
				mysqli_query($link, "delete from gallery where id = '".$_POST["id"][$i]."'");
			
			else
			{
				if(!empty($_POST["display".$_POST["id"][$i]]))
					mysqli_query($link, "update gallery set display = 1 where id = '".$_POST["id"][$i]."'");
				else
					mysqli_query($link, "update gallery set display = 0 where id = '".$_POST["id"][$i]."'");
			}
		}
		header("location:admin.php?redo=image");
	}
	elseif($from == "total")
	{
		mysqli_query($link, "update visit set count = '".$_POST["text"]."'");
		header("location:admin.php?redo=total");
	}
	elseif($from == "bottom")
	{
		mysqli_query($link, "update footer set text = '".$_POST["text"]."'");
		header("location:admin.php?redo=bottom");
	}
	elseif($from == "newsadd")
	{
		mysqli_query($link, "insert into news values(null, '".$_POST["text"]."', 1)");
		header("location:admin.php?redo=news");
	}
	elseif($from == "news")
	{
		for($i = 0; $i < count($_POST["id"]); $i++)
		{
			if(!empty($_POST["delete".$_POST["id"][$i]]))
				mysqli_query($link, "delete from news where id = '".$_POST["id"][$i]."'");
			
			else
			{
				if(!empty($_POST["display".$_POST["id"][$i]]))
					mysqli_query($link, "update news set display = 1, text = '".$_POST["text".$_POST["id"][$i]]."' where id = '".$_POST["id"][$i]."'");
				else
					mysqli_query($link, "update news set display = 0 , text = '".$_POST["text".$_POST["id"][$i]]."' where id = '".$_POST["id"][$i]."'");
			}
		}
		header("location:admin.php?redo=news");
	}
	elseif($from == "adminadd")
	{
		mysqli_query($link, "insert into admin values(null, '".$_POST["acc"]."', '".$_POST["pass"]."', 1)");
		header("location:admin.php?redo=admin");
	}
	elseif($from == "admin")
	{
		for($i = 0; $i < count($_POST["id"]); $i++)
		{
			if(!empty($_POST["delete".$_POST["id"][$i]]))
				mysqli_query($link, "delete from admin where id = '".$_POST["id"][$i]."'");
			
			else
				mysqli_query($link, "update admin set acc = '".$_POST["acc".$_POST["id"][$i]]."',  pass = '".$_POST["pass".$_POST["id"][$i]]."' where id = '".$_POST["id"][$i]."'");
		}
		header("location:admin.php?redo=admin");
	}
	elseif($from == "menu")
	{
		for($i = 0; $i < count($_POST["id"]); $i++)
		{
			if(!empty($_POST["delete".$_POST["id"][$i]]))
				mysqli_query($link, "delete from menu where id = '".$_POST["id"][$i]."'");
			
			else
			{
				if(!empty($_POST["display".$_POST["id"][$i]]))
					mysqli_query($link, "update menu set text = '".$_POST["text".$_POST["id"][$i]]."',  href = '".$_POST["href".$_POST["id"][$i]]."', display = 1 where id = '".$_POST["id"][$i]."'");
				else
					mysqli_query($link, "update menu set text = '".$_POST["text".$_POST["id"][$i]]."',  href = '".$_POST["href".$_POST["id"][$i]]."', display = 0 where id = '".$_POST["id"][$i]."'");
			}
		}
		header("location:admin.php?redo=menu");
	}
	elseif($from == "menuupdate")
	{
		if(isset($_POST["id"]))
		{
			for($i = 0; $i < count($_POST["id"]); $i++)
			{
				if(!empty($_POST["delete".$_POST["id"][$i]]))
					mysqli_query($link, "delete from menu where id = '".$_POST["id"][$i]."'");
				
				else
				{
					if(!empty($_POST["display".$_POST["id"][$i]]))
						mysqli_query($link, "update menu set text = '".$_POST["text".$_POST["id"][$i]]."',  href = '".$_POST["href".$_POST["id"][$i]]."', display = 1 where id = '".$_POST["id"][$i]."'");
					else
						mysqli_query($link, "update menu set text = '".$_POST["text".$_POST["id"][$i]]."',  href = '".$_POST["href".$_POST["id"][$i]]."', display = 0 where id = '".$_POST["id"][$i]."'");
				}
			}
		}
		
		if(isset($_POST["text2"]))
		{
			for($i = 0; $i < count($_POST["text2"]); $i++)
			{
				mysqli_query($link, "insert into menu values (null, '".$_POST["text2"][$i]."', '".$_POST["href2"][$i]."', 1, '".$_GET["id"]."')");
			}
		}
		header("location:admin.php?redo=menu");
	}
	elseif($from == "menuadd")
	{
		$text = $_POST["text"];
		$href = $_POST["href"];
		
		mysqli_query($link, "insert into menu values (null, '".$text."','".$href."', 1, 0)");
		header("location:admin.php?redo=menu");
	}
?>