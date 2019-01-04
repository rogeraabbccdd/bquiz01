<p class="t cent botli">動畫圖片管理</p>
        <form method="post" action="api.php?do=<?=$_GET["redo"]?>">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="45%">動畫圖片</td><td width="7%">顯示</td><td width="7%">刪除</td><td></td>
                    </tr>
					<?php
						$result = mq(sql($_GET["redo"], 0));
						while(fa2($row, $result))
						{
							?>
							<tr>
							<input type="hidden" name="id[]" value="<?=$row["id"]?>">
							<td><embed src="img/<?=$row["file"]?>"></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="display[]" <?=($row["display"])?"checked":""?>></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
							<td><input type="button" onclick="op('#cover','#cvr','view.php?do=up<?=$_GET["redo"]?>&id=<?=$row["id"]?>')" value="更換動畫"></td>
							</tr>
							<?php
						}
					?>
    </tbody></table>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=n<?=$_GET["redo"]?>&#39;)" value="新增動畫圖片"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>