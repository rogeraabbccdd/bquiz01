---
description: 編輯atotal.php
---

# 進站總人數管理

## 編輯表單
複製前面完成的後台管理頁，貼過來修改
```php
<p class="t cent botli">進站總人數管理</p>
<form method="post" action="api.php?do=<?=$_GET["redo"]?>">
	進站總人數<input type="text" name="<?=$_GET["redo"]?>" value="<?=$total?>">
	<input type="submit">
</form>
```

## 寫入API
在 api.php 加入處理表單的程式碼  
```php
case "total":
	upd($_POST, "total", 0);
	lo("admin.php?redo=total");
	break;
```