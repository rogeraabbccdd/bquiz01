---
description: 編輯amenu.php
---

# 管理者帳號管理

## 編輯表單
複製前面完成的後台管理頁，貼過來修改

### 顯示後台資料

修改第一列的標題文字後，在後面顯示資料內容  
表格的寬度可改可不改，因為題目沒有要求版型  
```php
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
```
完成後修改下方新增按鈕的字

## 編輯彈出視窗
在 view.php 加入彈出視窗  
這頁有新增和修改兩個  
編輯次選單比較麻煩，現有的和新增的name不能一樣才能判斷哪個要insert進資料庫，而且還要運用一點js語法製作新增按鈕
```php
<?php
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
				$result = All(sql("menu", 0)." where parent =".$_GET["id"]);
				foreach($result as $row)
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
?>
```

## 寫入API
在 api.php 加入處理表單的程式碼  
```php
case "upmenu":
	// 先處理舊有的次選單
	upd($_POST, "menu", 0);
	// 在處理新的次選單
	// 因為新的欄位和舊的一樣，input的name卻不一樣所以我就不套function
	for($i=0; $i<count($_POST["text2"]); $i++)
	{
		All("insert into menu values (null, '".$_POST["text2"][$i]."', '".$_POST["href2"][$i]."', '1', '".$_GET["id"]."')");
	}
	foreach($_POST["del2"] as $d)
	{
		All("delete from menu where id = '".$d."'");
	}
	lo("admin.php?redo=menu");
	break;

case "nmenu":
	upd($_POST, "menu", 1);
	lo("admin.php?redo=menu");
	break;
```