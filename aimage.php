                                    <p class="t cent botli">校園映像資料管理</p>
        <form method="post" action="api.php?do=image" enctype="multipart/form-data">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="23%">文字</td><td width="7%">顯示</td><td width="7%">刪除</td><td></td>
                    </tr>
					<?php
						if(empty($_GET["p"]))	$p = 1;
						else	$p = $_GET["p"];
						$sql = page("gallery", $p, 3, 0);
						$result = mysqli_query($link, $sql);
						while($row = mysqli_fetch_array($result))
						{
							?>
							<tr>
							<input type="hidden" name="id[]" value="<?=$row["id"]?>">
							<td><img src="img/<?=$row["file"]?>" width="100" height="68"></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="dis[]" <?=($row["display"])?"checked":""?>></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
							<td><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=upimg&id=<?=$row["id"]?>&#39;)" value="更新圖片"></td>
							</tr>
							<?php
						}
					?>
    </tbody></table>
	<?=pagelink("gallery", $p, 3, 0, "image");?>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=nimg&#39;)" value="新增動畫圖片"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>