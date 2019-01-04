<?php
	include_once "sql.php";

	switch($_GET["do"])
	{
		case "uptitle":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>&id=<?=$_GET["id"]?>">
			<input type="file" name="file">
			<input type="submit">
			</form>
			<?php
			break;

		case "ntitle":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>">
			<input type="file" name="file">
			<input type="text" name="text">
			<input type="submit">
			</form>
			<?php
			break;
		
		case "nad":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>">
			<input type="text" name="text">
			<input type="submit">
			</form>
			<?php
			break;

		case "upmvim":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>&id=<?=$_GET["id"]?>">
			<input type="file" name="file">
			<input type="submit">
			</form>
			<?php
			break;

		case "nmvim":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>">
			<input type="file" name="file">
			<input type="submit">
			</form>
			<?php
			break;

		case "upimage":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>&id=<?=$_GET["id"]?>">
			<input type="file" name="file">
			<input type="submit">
			</form>
			<?php
			break;

		case "nimage":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>">
			<input type="file" name="file">
			<input type="submit">
			</form>
			<?php
			break;
		
		case "nnews":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>">
			<textarea name="text"></textarea>
			<input type="submit">
			</form>
			<?php
			break;
		
		case "nadmin":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>">
			<input type="text" name="acc">
			<input type="password" name="pass">
			<input type="submit">
			</form>
			<?php
			break;

		case "nmenu":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>">
			<input type="text" name="text">
			<input type="text" name="href">
			<input type="submit">
			</form>
			<?php
			break;

		case "upmenu":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>&id=<?=$_GET["id"]?>">
			<table id="upmenu">
				<tr>
					<td>次選單名稱</td>
					<td>次選單連結網址</td>
					<td>刪除</td>
				</tr>
				<?php
					$result = mq(sql("menu", 0)." where parent =".$_GET["id"]);
					while(fa2($row, $result))
					{
						?>
						<tr>
							<td><input type="text" value="<?=$row["text"]?>" name="text[<?=$row["id"]?>]"></td>
							<td><input type="text" value="<?=$row["href"]?>" name="href[<?=$row["id"]?>]"></td>
							<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
						</tr>
						<?php
					}
				?>
			</table>
			<input type="submit"><input type="button" value="更多次選單" id="more">
			</form>
			<script>
				$("#more").click(function(){
					let add = `<tr>
							<td><input type="text" value="" name="text2[<?=$row["id"]?>]"></td>
							<td><input type="text" value="" name="href2[<?=$row["id"]?>]"></td>
							<td><input type="checkbox" value="" name="del2[]"></td>
						</tr>
					`;
					$("#upmenu").append(add);
				})
			</script>
			<?php
			break;
	}
?>