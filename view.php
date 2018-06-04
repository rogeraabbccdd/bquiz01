<?php
	include "sql.php";
	$do = $_GET["do"];
	if($do == "titleupload")
	{
		?>
		<form method="post" action="api.php?from=titleupload" enctype="multipart/form-data">
		<table style="width:50%; margin:auto">
			<tr>
				<td width="40%">標題區圖片</td>
				<td width="60%"><input type="file" name="file" value=""></td>
			</tr>
			<tr>
				<td width="40%">標題區替代文字</td>
				<td width="60%"><input type="text" name="text" value=""></td>
			</tr>
			<tr>
			<td colspan="2">
			<input type="submit" value="新增"><input type="reset" value="重置"></td>
			</tr>
		</table>
		</form>
		<?php
	}
	elseif($do == "titleupdate")
	{
		?>
		<form method="post" action="api.php?from=titleupdate&id=<?=$_GET["id"]?>" enctype="multipart/form-data">
		<table style="width:50%; margin:auto">
			<tr>
				<td width="40%">標題區圖片</td>
				<td width="60%"><input type="file" name="file" value=""></td>
			</tr>
			<tr>
			<td colspan="2">
			<input type="submit" value="新增"><input type="reset" value="重置">
			</tr>
		</table>
		</form>
		<?php
	}
	elseif($do == "advert")
	{
		?>
		<form method="post" action="api.php?from=advertadd" enctype="multipart/form-data">
		<table style="width:50%; margin:auto">
			<tr>
				<td width="40%">新增動態文字廣告</td>
				<td width="60%"><input type="text" name="text" value=""></td>
			</tr>
			<tr>
			<td colspan="2">
			<input type="submit" value="新增"><input type="reset" value="重置">
			</tr>
		</table>
		</form>
		<?php
	}
	elseif($do == "mvimupload")
	{
		?>
		<form method="post" action="api.php?from=mvimupload" enctype="multipart/form-data">
		<table style="width:50%; margin:auto">
			<tr>
				<td width="40%">新增動畫圖片</td>
				<td width="60%"><input type="file" name="file" value=""></td>
			</tr>
			<tr>
			<td colspan="2">
			<input type="submit" value="新增"><input type="reset" value="重置"></td>
			</tr>
		</table>
		</form>
		<?php
	}
	elseif($do == "mvimupdate")
	{
		?>
		<form method="post" action="api.php?from=mvimupload&id=<?=$_GET["id"]?>" enctype="multipart/form-data">
		<table style="width:50%; margin:auto">
			<tr>
				<td width="40%">新增動畫圖片</td>
				<td width="60%"><input type="file" name="file" value=""></td>
			</tr>
			<tr>
			<td colspan="2">
			<input type="submit" value="新增"><input type="reset" value="重置"></td>
			</tr>
		</table>
		</form>
		<?php
	}
	elseif($do == "imageupload")
	{
		?>
		<form method="post" action="api.php?from=imageupload" enctype="multipart/form-data">
		新增校園映像圖片
			<hr>
			<input type="file" name="file" value=""></td>
			<br>
			<input type="submit" value="新增"><input type="reset" value="重置"></td>
		</form>
		<?php
	}
	elseif($do == "imageupdate")
	{
		?>
		<form method="post" action="api.php?from=imageupdate&id=<?=$_GET["id"]?>" enctype="multipart/form-data">
			新增校園映像圖片
			<hr>
			<input type="file" name="file" value=""></td>
			<br>
			<input type="submit" value="新增"><input type="reset" value="重置"></td>
		</form>
		<?php
	}
	elseif($do == "news")
	{
		?>
		<form method="post" action="api.php?from=newsadd" enctype="multipart/form-data">
			新增最新消息資料
			<hr>
			<textarea name="text"></textarea>
			<br>
			<input type="submit" value="新增"><input type="reset" value="重置"></td>
		</form>
		<?php
	}
	elseif($do == "admin")
	{
		?>
		<form method="post" action="api.php?from=adminadd" enctype="multipart/form-data">
			新增管理者帳號
			<hr>
			帳號：<input type="text" name="acc"  value="">
			<br>
			密碼：<input type="text" name="pass"  value="">
			<br>
			<input type="submit" value="新增"><input type="reset" value="重置"></td>
		</form>
		<?php
	}
	elseif($do == "menuupdate")
	{
		?>
		<form method="post" action="api.php?from=menuupdate&id=<?=$_GET["id"]?>" enctype="multipart/form-data">
			編輯次選單
			<hr>
			<table id="sub">
			<tr>
				<td>次選單名稱</td>
				<td>次選單連結網址</td>
				<td>刪除</td>
			</tr>
			<?php
				$result = mysqli_query($link, "select * from menu where parent = '".$_GET["id"]."'");
				while($row = mysqli_fetch_array($result))
				{
					?>
					<tr>
					<td><input type="text" name="text[]"  value="<?=$row["text"]?>"></td>
					<td><input type="text" name="href[]"  value="<?=$row["href"]?>"></td>
					<td><input type="checkbox" name="delete[]" value="<?=$row["id"]?>"></td>
					<input type="hidden" name="id" value="<?=$row["id"]?>">
					</tr>
					<?php
				}
			?>
			</table>
			<input type="submit" value="修改確定"><input type="reset" value="重置">
			<input type="button" onclick="javascript:moresub();" value="更多次選單"></td>
		</form>
		<script>
		function moresub(){
			let mstr='<tr><td><input type="text" name="text2[]"  value=""></td><td><input type="text" name="href2[]"  value=""></td><td><input type="checkbox" name="del2[]"></td></tr>';
			$("#sub").append(mstr);
		}
		</script>
		<?php
	}
	elseif($do == "menu")
	{
		?>
		<form method="post" action="api.php?from=menuadd" enctype="multipart/form-data">
			新增主選單
			<hr>
			<table id="sub">
			<tr>
				<td>主選單名稱</td>
				<td>主選單連結網址</td>
			</tr>
			<tr>
				<td><input type="text" name="text"  value=""></td>
				<td><input type="text" name="href"  value=""></td>
			</tr>
			</table>
			<input type="submit" value="新增"><input type="reset" value="重置">
		</form>
		<script>
		function moresub(){
			let mstr='<tr><td><input type="text" name="text2[]"  value=""></td><td><input type="text" name="href2[]"  value=""></td><td><input type="checkbox" name="del2[]"></td></tr>';
			$("#sub").append(mstr);
		}
		</script>
		<?php
	}
?>