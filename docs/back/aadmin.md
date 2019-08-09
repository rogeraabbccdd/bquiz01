---
description: 編輯aadmin.php
---

# 管理者帳號管理

## 編輯表單
複製前面完成的後台管理頁，貼過來修改

### 顯示後台資料

修改第一列的標題文字後，在後面顯示資料內容  
表格的寬度可改可不改，因為題目沒有要求版型  
```php
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
```
完成後修改下方新增按鈕的字

## 編輯彈出視窗
在 view.php 加入彈出視窗  
這頁只有新增
```php
<?php
case "nadmin":
	?>
	<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>">
	<input type="text" name="acc">
	<input type="password" name="pass">
	<input type="submit">
	</form>
	<?php
	break;
?>
```

## 寫入API
在 api.php 加入處理表單的程式碼  
```php
case "admin":
	upd($_POST, "admin", 0);
	lo("admin.php?redo=admin");
	break;

case "nadmin":
	upd($_POST, "admin", 1);
	lo("admin.php?redo=admin");
	break;
```
 

 