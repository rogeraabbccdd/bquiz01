                            <p class="t cent botli">網站標題管理</p>
        <form method="post" action="api.php?do=title">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="45%">網站標題</td><td width="23%">替代文字</td><td width="7%">顯示</td><td width="7%">刪除</td><td></td>
                    </tr>
					<?php
						$result = mq(sql("title", 0));
						while(fa2($row, $result))
						{
							?>
							<tr>
							<input type="hidden" name="id[]" value="<?=$row["id"]?>">
							<td><img src="img/<?=$row["file"]?>" width="400"></td>
							<td><input type="text" value="<?=$row["text"]?>" name="text[<?=$row["id"]?>]"></td>
							<td><input type="radio" value="<?=$row["id"]?>" name="display" <?=($row["display"])?"checked":""?>></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
							<td><input type="button" onclick="op('#cover','#cvr','view.php?do=uptitle&id=<?=$row["id"]?>')" value="更新圖片"></td>
							</tr>
							<?php
						}
					?>
    </tbody></table>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=ntitle&#39;)" value="新增網站標題圖片"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>