<p class="t cent botli">選單管理</p>
        <form method="post" action="api.php?do=<?=$_GET["redo"]?>">
    <table width="100%">
    	<tbody><tr class="yel">
			<td width="45%">主選單名稱</td><td width="23%">主選單連結網址</td><td>次選單數</td><td width="7%">顯示</td><td width="7%">刪除</td><td></td>
                    </tr>
					<?php
						$result = All(sql($_GET["redo"], 0)." where parent = '0'");
						foreach($result as $row)
						{
							?>
							<tr>
							<input type="hidden" name="id[]" value="<?=$row["id"]?>">
							<td><input type="text" value="<?=$row["text"]?>" name="text[<?=$row["id"]?>]"></td>
							<td><input type="text" value="<?=$row["href"]?>" name="href[<?=$row["id"]?>]"></td>
							<td><?=count(All("select count(*) from menu where parent =".$row["id"]))[0][0]?></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="display[]" <?=($row["display"])?"checked":""?>></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
							<td><input type="button" onclick="op('#cover','#cvr','view.php?do=up<?=$_GET["redo"]?>&id=<?=$row["id"]?>')" value="編輯次選單"></td>
							</tr>
							<?php
						}
					?>
    </tbody></table>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=n<?=$_GET["redo"]?>&#39;)" value="新增主選單"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>