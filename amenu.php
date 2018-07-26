                                    <p class="t cent botli">管理者帳號管理</p>
        <form method="post" action="api.php?do=menu" enctype="multipart/form-data">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="23%">主選單名稱</td><td width="7%">主選單連結網址</td><td width="7%">次選單數</td><td width="7%">顯示</td><td width="7%">刪除</td><td></td>
                    </tr>
					<?php
						$result = mysqli_query($link, sql("menu", 0)." where parent = '0'");
						while($row = mysqli_fetch_array($result))
						{
							?>
							<tr>
							<input type="hidden" name="id[]" value="<?=$row["id"]?>">
							<td><input type="text" value="<?=$row["text"]?>" name="text[]"></td>
							<td><input type="text" value="<?=$row["href"]?>" name="href[]"></td>
							<?php
								$result2 = mysqli_query($link, sql("menu", 0)." where parent = '".$row["id"]."'");
								echo "<td>".mysqli_num_rows($result2)."</td>";
							?>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="dis[]" <?=($row["display"])?"checked":""?>></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
							<td><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=sub&id=<?=$row["id"]?>&#39;)" value="編輯次選單"></td>
							</tr>
							<?php
						}
					?>
    </tbody></table>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=nmenu&#39;)" value="新增主選單"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>