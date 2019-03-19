---
description: 編輯aimage.php
---

# 校園映像資料管理

## 編輯表單
複製前面完成的後台管理頁，貼過來修改

### 顯示後台資料

修改第一列的標題文字後，在後面顯示資料內容  
表格的寬度可改可不改，因為題目沒有要求版型  
這頁需要做分頁，每三張圖一頁，且有規定後台圖片大小  
分頁的function在前台的最新消息頁已經寫好了，直接套用即可
```php
<?php
	$p = 1;
	if(!empty($_GET["p"]))	$p = $_GET["p"];
	$sql = page($_GET["redo"], $p, 3, 0);
	$result = All($sql);
	foreach($result as $row)
	{
		?>
		<tr>
		<input type="hidden" name="id[]" value="<?=$row["id"]?>">
		<td><img src="img/<?=$row["file"]?>" width="100" height="68"></td>
		<td><input type="checkbox" value="<?=$row["id"]?>" name="display[]" <?=($row["display"])?"checked":""?>></td>
		<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
		<td><input type="button" onclick="op('#cover','#cvr','view.php?do=<?=$_GET["redo"]?>&id=<?=$row["id"]?>')" value="更換圖片"></td>
		</tr>
		<?php
	}
?>
```
然後在資料表格下方加入頁碼
```php
<?=pagelink($_GET["redo"], $p, 3, 0, $_GET["redo"]);?>
```
最後再修改下方新增按鈕的字

## 編輯彈出視窗
在 view.php 加入彈出視窗  
這頁有新增和修改兩個
```php
<?php
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
?>
```

## 寫入API
在 api.php 加入處理表單的程式碼  
```php
case "image":
	upd($_POST, "image", 0);
	lo("admin.php?redo=image");
	break;

case "nimage":
	$nid = upd($_POST, "image", 1);
	upfile($_FILES, "image", $nid);
	lo("admin.php?redo=image");
	break;

case "upimage":
	upfile($_FILES, "image", $_GET["id"]);
	lo("admin.php?redo=image");
	break;
```