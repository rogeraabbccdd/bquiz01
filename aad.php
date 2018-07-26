                                    <p class="t cent botli">動態文字廣告管理</p>
        <form method="post" action="api.php?do=ad" enctype="multipart/form-data">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="23%">文字</td><td width="7%">顯示</td><td width="7%">刪除</td>
                    </tr>
					<?php
						$result = mysqli_query($link, sql("advert", 0));
						while($row = mysqli_fetch_array($result))
						{
							?>
							<tr>
							<input type="hidden" name="id[]" value="<?=$row["id"]?>">
							<td><input type="text" value="<?=$row["text"]?>" name="text[]"></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="dis[]" <?=($row["display"])?"checked":""?>></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
							</tr>
							<?php
						}
					?>
    </tbody></table>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=aad&#39;)" value="新增動態文字廣告"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>