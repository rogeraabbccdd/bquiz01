<?php
	$p = 1;
	if(!empty($_GET["p"]))	$p = $_GET["p"];
	$sql = page($_GET["redo"], $p, 3, 0);
?>
<p class="t cent botli">校園映像資料管理</p>
        <form method="post" action="api.php?do=<?=$_GET["redo"]?>">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="45%">校園映像資料圖片</td><td width="7%">顯示</td><td width="7%">刪除</td><td></td>
                    </tr>
					<?php
						$result = All($sql);
						foreach($result as $row)
						{
							?>
							<tr>
							<input type="hidden" name="id[]" value="<?=$row["id"]?>">
							<td><img src="img/<?=$row["file"]?>" width="100" height="68"></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="display[]" <?=($row["display"])?"checked":""?>></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
							<td><input type="button" onclick="op('#cover','#cvr','view.php?do=<?=$_GET["redo"]?>&id=<?=$row["id"]?>')" value="更換圖片"></td>
							</tr>
							<?php
						}
					?>
	</tbody></table>
	<?=pagelink($_GET["redo"], $p, 3, 0, $_GET["redo"]);?>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=n<?=$_GET["redo"]?>&#39;)" value="新增校園映像圖片"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>