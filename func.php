<?php
	function sql($tbl, $show)
	{
		$sql = "select * from ".$tbl;
		if($show)	$sql .= " where display = 1";
		
		return $sql;
	}
	
	function lo($link)
	{
		return header("location:".$link);
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
		
		$result = mysqli_query($link, sql($tbl, $s));
		$tp = ceil(mysqli_num_rows($result) / $l);
		
		$np = $p+1;
		$lp = $p-1;
		if($np > $tp)	$np = $tp;
		if($lp < 1)		$lp = 1;
		
		$r .= '<a class="bl" style="font-size:30px;" href="?p='.$lp.'&redo='.$redo.'"">&lt;&nbsp;</a>';
      
		for($i=1; $i<=$tp; $i++)
		{
			if($i == $p)	$r.= '<a class="bl" style="font-size:50px;" href="?do=meg&p='.$i.'&redo='.$redo.'">'.$i.'</a>';
			else	$r.= '<a class="bl" style="font-size:30px;" href="?do=meg&p='.$i.'&redo='.$redo.'">'.$i.'</a>';
		}
		
		$r .= '<a class="bl" style="font-size:30px;" href="?p='.$np.'&redo='.$redo.'">&nbsp;&gt;</a>';
		
		return $r;
	}
	
	function upd($tbl, $data, $redo)
	{
		global $link;
		
		foreach($data as $d => $value)
		{
			$$d = $value;
		}
		
		if(isset($text))
		{
			for($i=0; $i<count($text); $i++)
			{
				mysqli_query($link, "update ".$tbl." set text = '".$text[$i]."' where id = '".$id[$i]."'");
			}
		}
		
		if($redo == "image" || $redo == "news")	
		{
			for($i=0; $i<count($id); $i++)
			{
				mysqli_query($link, "update ".$tbl." set display = 0  where id = '".$id[$i]."'");
			}
		}
		else mysqli_query($link, "update ".$tbl." set display = 0");
		
		if(!empty($redo))
		{
			foreach($dis as $diss)
			{
				mysqli_query($link, "update ".$tbl." set display = 1 where id = '".$diss."'");
			}
		}
		else	mysqli_query($link, "update ".$tbl." set display = 1 where id = '".$dis."'");
		
		foreach($del as $dell)
		{
			mysqli_query($link, "delete from ".$tbl." where id = '".$dell."'");
		}
		
		lo("admin.php?redo=".$redo);
	}
	
	function upfile($tbl, $data, $redo, $id)
	{
		global $link;
		
		$date = strtotime("now");
		$ext = pathinfo($data["name"], PATHINFO_EXTENSION);
		$name = $date.".".$ext;
		
		copy($data["tmp_name"], "img/".$name);
		
		mysqli_query($link, "update ".$tbl." set file = '".$name."' where id = '".$id."'");
		
		lo("admin.php?redo=".$redo);
	}
?>