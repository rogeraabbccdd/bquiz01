---
description: 編輯amvim.php
---

# 動畫圖片管理

## 編輯表單
複製前面完成的後台管理頁，貼過來修改

### 顯示後台資料

修改第一列的標題文字後，在後面顯示資料內容  
表格的寬度可改可不改，因為題目沒有要求版型  
這裡也把更換按鈕的連結redo改為`<?=$_GET["redo"]?>`，之後的頁面就可以直接複製，不用修改
```php
<?php
	$result = All(sql($_GET["redo"], 0));
	foreach($result as $row)
	{
		?>
		<tr>
		<input type="hidden" name="id[]" value="<?=$row["id"]?>">
		<td><embed src="img/<?=$row["file"]?>"></td>
		<td><input type="checkbox" value="<?=$row["id"]?>" name="display[]" <?=($row["display"])?"checked":""?>></td>
		<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
		<td><input type="button" onclick="op('#cover','#cvr','view.php?do=up<?=$_GET["redo"]?>&id=<?=$row["id"]?>')" value="更換動畫"></td>
		</tr>
		<?php
	}
?>
```
下方新增按鈕的連結可以直接複製廣告管理的程式碼  
因為廣告管理已經換過連結的do了，所以改字就好

## 編輯彈出視窗
在 view.php 加入彈出視窗  
這頁有新增和修改兩個
```php
<?php
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

?>
```

## 寫入API
在 api.php 加入處理表單的程式碼  
```php
case "mvim":
	upd($_POST, "mvim", 0);
	lo("admin.php?redo=mvim");
	break;

case "nmvim":
	$nid = upd($_POST, "mvim", 1);
	upfile($_FILES, "mvim", $nid);
	lo("admin.php?redo=mvim");
	break;

case "upmvim":
	upfile($_FILES, "mvim", $_GET["id"]);
	lo("admin.php?redo=mvim");
	break;
```