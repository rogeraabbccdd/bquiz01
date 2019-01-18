<?php
	$pdo = new PDO("mysql:host=localhost;dbname=dbxx;charset=utf8", "root", "");
	/***** session *****/
	session_start();
	
	if(empty($_SESSION["v"]))
	{
		$_SESSION["v"] = "123";
		SQLExec("update total set count = count + 1");
	}
	
	if(empty($_SESSION["a"]))
	{
		$btn = "管理登入";
		$btnh = "login.php";
	}
	else
	{
		$btn = "回後台管理";
		$btnh = "admin.php";
	}
	
	function All($sql)
	{
		global $pdo;
		return $pdo->query($sql)->fetchAll();
	}

	function Fetch($sql)
	{
		global $pdo;
		return $pdo->query($sql)->fetch();
	}

	function SQLExec($sql)
	{
		global $pdo;
		return $pdo->exec($sql);
	}

	function lo($l)
	{
		return header("location:".$l);
	}
	
	function sql($tb, $dis)
	{
		$r = "select * from ".$tb;
		if($dis) 	$r .= " where display = 1";
		
		return $r;
	}
	
	function page($tbl, $p, $l, $s)
	{
		global $link;

		$start = $p*$l-$l;

		return sql($tbl, $s)." limit ".$start.", ".$l;
	}

	function pagelink($tbl, $p, $l, $s, $redo)
	{
		global $link;

		$r = "";

		$result = All(sql($tbl, $s));
		$tp = ceil(count($result) / $l);

		$np = $p+1;
		if($np > $tp)	$np = $tp;

		$lp = $p-1;
		if($lp < 1)		$lp = 1;

		$r .= '<a class="bl" style="font-size:30px;" href="?p='.$lp.'&redo='.$redo.'"">< </a>';

		for($i=1; $i<=$tp; $i++)
		{
			if($i == $p)	$r.= '<a class="bl" style="font-size:50px;" href="?do=meg&p='.$i.'&redo='.$redo.'">'.$i.'</a>';
			else	$r.= '<a class="bl" style="font-size:30px;" href="?do=meg&p='.$i.'&redo='.$redo.'">'.$i.'</a>';
		}

		$r .= '<a class="bl" style="font-size:30px;" href="?p='.$np.'&redo='.$redo.'"> ></a>';

		return $r;
	}
	
	function upd($post, $tbl, $insert)
	{
		global $link; 
		// 如果有要INSERT，先新增一筆只有ID的資料
		$newid = -1;
		if($insert)	
		{
			SQLExec("insert into ".$tbl." (id) values (null);");	
			$newid = $pdo->lastInsertId();
		}

		// 迴圈表單的資料
		// 先迴POST的NAME
		foreach($post as $name => $v)
		{
			// 有些資料不是陣列，例如title的display、新增文字廣告等
			if(!is_array($v))
			{
				switch($name){
					// title的display
					case "display":
						SQLExec("update ".$tbl." set display = 1 where id = ".$v);
						break;

					// footer、進站人數
					case "bottom":
					case "count":
						SQLExec("update ".$tbl." set ".$name." = '".$v."'");
						break;
					
					// 新增文字廣告、新增最新消息、新增管理員、新增主選單
					default:
						SQLExec("update ".$tbl." set ".$name." = '".$v."' where id = ".$newid);
						break;
				}
			}
			else
			{
				// 再迴每個NAME的陣列，陣列索引值為資料ID
				foreach($v as $id => $vv)
				{
					switch($name)
					{
						case "display":
							if($insert) $vv = $newid;
							SQLExec("update ".$tbl." set display = 1 where id = ".$vv);
							break;

						case "del":
							SQLExec("delete from ".$tbl." where id = ".$vv);
							break;
						
						case "id":
							SQLExec("update ".$tbl." set display = 0 where id = ".$vv);
							break;
						
						// 文字、管理者帳號及密碼、選單文字及連結
						default:
							if($insert) $vv = $newid;
							SQLExec("update ".$tbl." set ".$name." = '".$vv."' where id = ".$id);
							break;					
					}
				}
			}
		}

		// 回傳新增資料的ID，如果沒有新增資料則回傳-1
		return $newid;
	}
	
	
	function upfile($file, $tbl, $id)
	{
		$date = strtotime("now");
		$ext = pathinfo($file["file"]["name"], PATHINFO_EXTENSION);
		$name = $date.".".$ext;
		
		copy($file["file"]["tmp_name"], "img/".$name);
		
		SQLExec("update ".$tbl." set file = '".$name."' where id = '".$id."'");
	}

	/***** 共用資料 *****/
	$row = Fetch(sql("title", 1));
	$title = "img/".$row["file"];
	$title_text = $row["text"];
	
	$bottom = Fetch(sql("title", 1))[0];
	$total = Fetch(sql("title", 1))[0];
	
	$image = "<img src='img/01E01.jpg' onclick='pp(1)'><br>";
	$result = All(sql("image", 1));
	$inum = count($result);
	
	$i = 0;
	foreach($result as $row)
	{
		$image .= "<img src='img/".$row["file"]."' class='im' id='ssaa".$i."' width='150' height='103'>";
		$i++;
	}
	$image .= "<br><img src='img/01E02.jpg' onclick='pp(2)'>";
	
	$menu = "";
	$result = All(sql("menu", 1)." and parent = 0");
	foreach($result as $row)
	{
		$menu .= "<div class='mainmu'><a href='".$row["href"]."'>".$row["text"]."</a>";
		
		$result2 = All(sql("menu", 1)." and parent = '".$row["id"]."'");
		foreach($result2 as $row2)
		{
			$menu .= "<div class='mainmu2 mw'><a href='".$row2["href"]."' class='mainmu2 mw'>".$row2["text"]."</a></div>";
		}
		
		$menu .= "</div>";
	}
	
	$ad = "";
	$result = All(sql("ad", 1));
	foreach($result as $row)
	{
		$ad .= $row["text"]."&emsp;";
	}
?>