                                    <p class="t cent botli">最新消息資料管理</p>
        <form method="post" action="api.php?do=news" enctype="multipart/form-data">
    <table width="100%">
    	<tbody><tr class="yel">
        	<td width="23%">文字</td><td width="7%">顯示</td><td width="7%">刪除</td><td></td>
                    </tr>
					<?php
						if(empty($_GET["p"]))	$p = 1;
						else	$p = $_GET["p"];
						$sql = page("news", $p, 5, 0);
						$result = mysqli_query($link, $sql);
						while($row = mysqli_fetch_array($result))
						{
							?>
							<tr>
							<input type="hidden" name="id[]" value="<?=$row["id"]?>">
							<td><textarea name="text[]"><?=$row["text"]?></textarea></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="dis[]" <?=($row["display"])?"checked":""?>></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
							</tr>
							<?php
						}
					?>
    </tbody></table>
	<?=pagelink("news", $p, 5, 0, "news");?>
           <table style="margin-top:40px; width:70%;">
     <tbody><tr>
      <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=nnews&#39;)" value="新增最新消息資料"></td><td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
     </tr>
    </tbody></table>    

        </form>
