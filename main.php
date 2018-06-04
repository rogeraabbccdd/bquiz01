<?php
	if(!isset($_GET["redo"]))
	{
		?>
		 <p class="t cent botli">網站標題管理</p>
		 <form method="post" action="api.php?from=title">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="45%">網站標題</td><td width="23%">替代文字</td><td width="7%">顯示</td><td width="7%">刪除</td><td></td>
                    </tr>
    </tbody></table>
	   <table width="100%">
    	<tbody>
		<?php
			$result = mysqli_query($link, "select * from title");
			while($row = mysqli_fetch_array($result))
			{
		?>
			<tr>
				<td width="45%"><img src="img/<?=$row["file"]?>" width="300" height="30"></td>
				<td width="23%"><input type="text" name="text[]" value="<?=$row["text"]?>"></td>
				<td width="7%"><input type="radio" name="display" value="<?=$row["id"]?>" <?php if($row["display"] == 1) echo "checked"; ?>></td>
				<td width="7%"><input type="checkbox" name="delete[]" value="<?=$row["id"]?>"></td>
				<td><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=titleupdate&id=<?=$row["id"]?>&#39;)" value="更換圖片"></td>
						</tr>
		<?php
			}
		?>
    </tbody></table>
	
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=titleupload&#39;)" value="新增網站標題圖片"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>
		<?php
	}
	else
	{
		if($_GET["redo"] == "ad")
		{
			?>
		 <p class="t cent botli">動態文字廣告管理</p>
		 <form method="post" action="api.php?from=advert">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="68%">動態文字廣告</td><td width="7%">顯示</td><td width="7%">刪除</td>
                    </tr>
    </tbody></table>
	   <table width="100%">
    	<tbody>
		<?php
			$result = mysqli_query($link, "select * from advert");
			while($row = mysqli_fetch_array($result))
			{
		?>
			<tr>
				<td width="68%"><input type="text" name="text[]" value="<?=$row["text"]?>" style="width:95%"></td>
				<td width="7%"><input type="checkbox" name="display[]" value="<?=$row["id"]?>" <?php if($row["display"] == 1) echo "checked"; ?>></td>
				<td width="7%"><input type="checkbox" name="delete[]"  value="<?=$row["id"]?>"><input type="hidden" name="id[]" value="<?=$row["id"]?>"></td>
			</tr>
		<?php
			}
		?>
    </tbody></table>
	
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=advert&#39;)" value="新增動態文字廣告"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>
		<?php
		}
		
		elseif($_GET["redo"] == "mvim")
		{
			?>
		 <p class="t cent botli">動畫圖片管理</p>
		 <form method="post" action="api.php?from=mvim">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="68%">動畫圖片</td><td width="7%">顯示</td><td width="7%">刪除</td><td></td>
                    </tr>
    </tbody></table>
	   <table width="100%">
    	<tbody>
		<?php
			$result = mysqli_query($link, "select * from animate");
			while($row = mysqli_fetch_array($result))
			{
		?>
			<tr>
				<td width="68%"><embed src="img/<?=$row["file"]?>"></embed></td>
				<td width="7%"><input type="checkbox" name="display[]" value="<?=$row["id"]?>" <?php if($row["display"] == 1) echo "checked"; ?>></td>
				<td width="7%"><input type="checkbox" name="delete[]"  value="<?=$row["id"]?>"><input type="hidden" name="id[]" value="<?=$row["id"]?>"></td>
			<td><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=mvimupdate&id=<?=$row["id"]?>&#39;)" value="更換動畫"><input type="hidden" name="id[]" value="<?=$row["id"]?>"></td>
						</tr>
		<?php
			}
		?>
    </tbody></table>
	
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=mvimupload&#39;)" value="新增動畫圖片"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>
		<?php
		}
		elseif($_GET["redo"] == "image")
		{
			?>
		 <p class="t cent botli">校園映像管理</p>
		 <form method="post" action="api.php?from=image">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="68%">校園映像資料圖片</td><td width="7%">顯示</td><td width="7%">刪除</td><td></td>
                    </tr>
    </tbody></table>
	   <table width="100%">
    	<tbody>
		<?php
			if(!isset($_GET["p"]))	$page = 1;
			else $page = $_GET["p"];
			$start = $page*3-3;
			$ol = $start +1;
			$result = mysqli_query($link, "select * from news");
			$total = mysqli_num_rows($result);
			
			if($page == 1)
				$result = mysqli_query($link, "select * from gallery order by id limit 3");
			else
				$result = mysqli_query($link, "select * from gallery order by id limit ".$start.", 3");
			
			$totalp = ceil($total/3);
			while($row = mysqli_fetch_array($result))
			{
		?>
			<tr>
				<td width="68%"><img src="img/<?=$row["file"]?>" width="100" height="68"></td>
				<td width="7%"><input type="checkbox" name="display[]" value="<?=$row["id"]?>" <?php if($row["display"] == 1) echo "checked"; ?>></td>
				<td width="7%"><input type="checkbox" name="delete[]"  value="<?=$row["id"]?>"><input type="hidden" name="id[]" value="<?=$row["id"]?>"></td>
			<td><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=imageupdate&id=<?=$row["id"]?>&#39;)" value="更換動畫"><input type="hidden" name="id[]" value="<?=$row["id"]?>"></td>
						</tr>
		<?php
			}
		?>
    </tbody></table>
		<?php
			$lp = $page -1;
			$np = $page +1;
			
			if($lp<1)	$lp = 1;
			if($np>$totalp)	$np = $totalp;
			echo '<a class="bl" style="font-size:30px;" href="?redo=image&p='.$lp.'"><</a>';
			
			for($i = 1; $i<=$totalp; $i++)
			{
				if($i != $page)
					echo '<a class="bl" style="font-size:30px;" href="?redo=image&p='.$i.'">'.$i.'</a>';
				else
					echo '<a class="bl" style="font-size:50px;" href="?redo=image&p='.$i.'">'.$i.'</a>';
			}
			
			echo '<a class="bl" style="font-size:30px;" href="?redo=image&p='.$np.'">></a>';
		?>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=mvimupload&#39;)" value="新增校園映像圖片"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>
		<?php
		}
		elseif($_GET["redo"] == "total")
		{
			?>
		 <p class="t cent botli">進站總人數管理</p>
		 <form method="post" action="api.php?from=total">
			<input type="text" name="text" value="<?=$visit?>">
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>
		<?php
		}
		elseif($_GET["redo"] == "bottom")
		{
			?>
		 <p class="t cent botli">頁尾版權資料管理</p>
		 <form method="post" action="api.php?from=bottom">
			<input type="text" name="text" value="<?=$footer?>">
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>
		<?php
		}
		elseif($_GET["redo"] == "news")
		{
			?>
		 <p class="t cent botli">最新消息資料管理</p>
		 <form method="post" action="api.php?from=news">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="68%">最新消息資料內容</td><td width="7%">顯示</td><td width="7%">刪除</td><td></td>
                    </tr>
    </tbody></table>
	   <table width="100%">
    	<tbody>
		<?php
			if(!isset($_GET["p"]))	$page = 1;
			else $page = $_GET["p"];
			$start = $page*5-5;
			$ol = $start +1;
			$result = mysqli_query($link, "select * from news");
			$total = mysqli_num_rows($result);
			
			if($page == 1)
				$result = mysqli_query($link, "select * from news order by id limit 5");
			else
				$result = mysqli_query($link, "select * from news order by id limit ".$start.", 5");
			
			$totalp = ceil($total/5);
			while($row = mysqli_fetch_array($result))
			{
		?>
			<tr>
				<td width="68%"><textarea name="text<?=$row["id"]?>"><?=$row["text"]?></textarea></td>
				<td width="7%"><input type="checkbox" name="display[]" value="<?=$row["id"]?>" <?php if($row["display"] == 1) echo "checked"; ?>></td>
				<td width="7%"><input type="checkbox" name="delete[]"  value="<?=$row["id"]?>"></td>
			<td><input type="hidden" name="id[]" value="<?=$row["id"]?>"></td>
						</tr>
		<?php
			}
		?>
    </tbody></table>
		<?php
			$lp = $page -1;
			$np = $page +1;
			
			if($lp<1)	$lp = 1;
			if($np>$totalp)	$np = $totalp;
			
			echo '<a class="bl" style="font-size:30px;" href="?redo=news&p='.$lp.'"><</a>';
			
			for($i = 1; $i<=$totalp; $i++)
			{
				if($i != $page)
					echo '<a class="bl" style="font-size:30px;" href="?redo=news&p='.$i.'">'.$i.'</a>';
				else
					echo '<a class="bl" style="font-size:50px;" href="?redo=news&p='.$i.'">'.$i.'</a>';
			}
			
			echo '<a class="bl" style="font-size:30px;" href="?redo=news&p='.$np.'">></a>';
		?>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=news&#39;)" value="新增最新消息資料"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    
        </form>
		<?php
		}
		elseif($_GET["redo"] == "admin")
		{
			?>
		 <p class="t cent botli">管理者帳號管理</p>
		 <form method="post" action="api.php?from=admin">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="45%">帳號</td><td width="45%">密碼</td><td width="10%">刪除</td><td></td>
                    </tr>
    </tbody></table>
	   <table width="100%">
    	<tbody>
		<?php
			$result = mysqli_query($link, "select * from admin");
			while($row = mysqli_fetch_array($result))
			{
		?>
			<tr>
				<td width="68%"><input type="text" name="acc[]"  value="<?=$row["acc"]?>"></td>
				<td width="7%"><input type="password" name="pass[]"  value="<?=$row["pass"]?>" ></td>
				<td width="7%"><input type="checkbox" name="delete[]"  value="<?=$row["id"]?>"><input type="hidden" name="id[]" value="<?=$row["id"]?>"></td>
			</tr>
		<?php
			}
		?>
    </tbody></table>
	
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=admin&#39;)" value="新增管理者帳號"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>
		<?php
		}
		elseif($_GET["redo"] == "menu")
		{
			?>
		 <p class="t cent botli">選單管理</p>
		 <form method="post" action="api.php?from=menu">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="16%">主選單名稱</td>
			<td width="16%">選單連結網址</td>
			<td width="16%">次選單數</td>
			<td width="16%">顯示</td>
			<td width="16%">刪除</td>
			<td width="16%"></td>
                    </tr>
    </tbody></table>
	   <table width="100%">
    	<tbody>
		<?php
			$result = mysqli_query($link, "select * from menu where parent = 0");
			while($row = mysqli_fetch_array($result))
			{
				$result2 = mysqli_query($link, "select * from menu where parent = '".$row["id"]."'");
				$sub = mysqli_num_rows($result2);
		?>
			<tr>
				<td width="16%"><input type="text" name="text[]"  value="<?=$row["text"]?>" style="width:90%"></td>
				<td width="16%"><input type="text" name="href[]"  value="<?=$row["href"]?>" style="width:90%"></td>
				<td width="16%"><?=$sub?></td>
				<td width="16%"><input type="checkbox" name="display[]" value="<?=$row["id"]?>" <?php if($row["display"] == 1) echo "checked"; ?>></td>
				<td width="16%"><input type="checkbox" name="delete[]"  value="<?=$row["id"]?>">
				<input type="hidden" name="id[]" value="<?=$row["id"]?>"></td>
				<td width="16%"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=menuupdate&id=<?=$row["id"]?>&#39;)" value="編輯次選單"></td>
			</tr>
		<?php
			}
		?>
    </tbody></table>
	
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=menu&#39;)" value="新增主選單"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>
		<?php
		}
	}
?>