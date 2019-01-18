<p class="t cent botli">管理者帳號管理</p>
        <form method="post" action="api.php?do=<?=$_GET["redo"]?>">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="45%">帳號</td><td width="23%">密碼</td><td width="7%">刪除</td><td></td>
                    </tr>
					<?php
						$result = All(sql("admin", 0));
						foreach($result as $row)
						{
							?>
							<tr>
							<input type="hidden" name="id[]" value="<?=$row["id"]?>">
							<td><input type="text" value="<?=$row["acc"]?>" name="acc[<?=$row["id"]?>]"></td>
							<td><input type="password" value="<?=$row["pass"]?>" name="pass[<?=$row["id"]?>]"></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
							</tr>
							<?php
						}
					?>
    </tbody></table>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=n<?=$_GET["redo"]?>&#39;)" value="新增管理者帳號"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>