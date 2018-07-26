<?php
	include_once "sql.php";
	
	switch($_GET["do"])
	{
		case "uptitle":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=uptitle&id=<?=$_GET["id"]?>">
			<input type="file" name="file">
			<input type="submit">
			</form>
			<?php
			break;
		
		case "title":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=ntitle">
			<input type="file" name="file">
			<input type="text" name="text">
			<input type="submit">
			</form>
			<?php
			break;
		
		case "aad":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=nad">
			<input type="text" name="text">
			<input type="submit">
			</form>
			<?php
			break;
		
		case "upmvim":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=upmvim&id=<?=$_GET["id"]?>">
			<input type="file" name="file">
			<input type="submit">
			</form>
			<?php
			break;	

		case "nmvim":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=nmvim">
			<input type="file" name="file">
			<input type="submit">
			</form>
			<?php
			break;	
		
		case "upimg":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=upimg&id=<?=$_GET["id"]?>">
			<input type="file" name="file">
			<input type="submit">
			</form>
			<?php
			break;	
			
		case "nimg":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=nimg">
			<input type="file" name="file">
			<input type="submit">
			</form>
			<?php
			break;	
			
		case "nnews":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=nnews">
			<textarea name="text"></textarea>
			<input type="submit">
			</form>
			<?php
			break;	
			
		case "nadmin":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=nadmin">
			<input type="text" name="acc">
			<input type="text" name="pw">
			<input type="submit">
			</form>
			<?php
			break;	
		
		case "sub":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=sub&id=<?=$_GET["id"]?>">
				<table id="tb">
			<?php
			$result = mysqli_query($link, sql("menu", 0)." where parent = '".$_GET["id"]."'");
			while($row = mysqli_fetch_array($result))
			{
				?>
				<tr><td>
				<input type="hidden" name="id[]" value="<?=$row["id"]?>">
			<input type="text" name="text[]" value="<?=$row["text"]?>">
			<input type="text" name="href[]" value="<?=$row["href"]?>">
			<input type="checkbox" name="del[]">
			</td></tr>
			<?php
			}
			?>
			</table>
			<input type="submit">
			<input type="button" onclick="sub()" value="更多次選單">
			</form>
			<script>
				function sub()
				{
					$("#tb").append(`
					<tr><td>
					<input type="text" name="text2[]" value="<?=$row["text"]?>">
					<input type="text" name="href2[]" value="<?=$row["href"]?>">
					<input type="checkbox" name="del2[]">
					</td></tr>
					`);
				}
			</script>
			<?php
			break;	
			
		case "nmenu":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=nmenu">
			<input type="text" name="text">
			<input type="text" name="href">
			<input type="submit">
			</form>
			<?php
			break;	
			
	}
?>