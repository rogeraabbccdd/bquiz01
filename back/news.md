---
description: 編輯anews.php
---

# 最新消息資料管理

## 編輯表單
複製前面完成的後台管理頁，貼過來修改

### 顯示後台資料

修改第一列的標題文字後，在後面顯示資料內容  
表格的寬度可改可不改，因為題目沒有要求版型  
這頁是否要做分頁功能我覺得蠻有爭議的，因為題本的文字敘規定的是前台的分頁  
保險起見，我這頁還是做了分頁，一頁5筆資料
```php
<?php
	$p = 1;
	if(!empty($_GET["p"]))	$p = $_GET["p"];
	$sql = page($_GET["redo"], $p, 5, 0);
	$result = All($sql);
	foreach($result as $row)
	{
		?>
		<tr>
		<input type="hidden" name="id[]" value="<?=$row["id"]?>">
		<td><textarea name="text[<?=$row["id"]?>]"><?=$row["text"]?></textarea></td>
		<td><input type="checkbox" value="<?=$row["id"]?>" name="display[]" <?=($row["display"])?"checked":""?>></td>
		<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
		</tr>
		<?php
	}
?>
```
然後在資料表格下方加入頁碼
```php
<?=pagelink($_GET["redo"], $p, 5, 0, $_GET["redo"]);?>
```
最後再修改下方新增按鈕的字

## 編輯彈出視窗
在 view.php 加入彈出視窗  
這頁只有新增
```php
<?php
case "nnews":
	?>
	<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>">
	<textarea name="text"></textarea>
	<input type="submit">
	</form>
	<?php
	break;
?>
```

## 寫入API
在 api.php 加入處理表單的程式碼  
```php
case "news":
	upd($_POST, "news", 0);
	lo("admin.php?redo=news");
	break;

case "nnews":
	upd($_POST, "news", 1);
	lo("admin.php?redo=news");
	break;
```