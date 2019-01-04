---
description: 編輯aad.php
---

# 動態文字廣告管理

## 編輯表單
複製`atitle.php`的內容

### 編輯 form 標籤

把 form 標籤的`target="back"` 刪除，然後把action改為 api.php  
把連結的do改為`<?=$_GET["redo"]?>`，之後複製其他頁面時就不用再改這裡  
因為標題管理沒有redo變數，所以在這邊才改

```html
 <form method="post" action="api.php?do=<?=$_GET["redo"]?>">
```

### 顯示後台資料

修改第一列的標題文字後，在後面顯示資料內容  
表格的寬度可改可不改，因為題目沒有要求版型
```php
<?php
	$result = mq(sql($_GET["redo"], 0));
	while(fa2($row, $result))
	{
		?>
		<tr>
		<input type="hidden" name="id[]" value="<?=$row["id"]?>">
		<td><input type="text" value="<?=$row["text"]?>" name="text[<?=$row["id"]?>]"></td>
		<td><input type="checkbox" value="<?=$row["id"]?>" name="display[]" <?=($row["display"])?"checked":""?>></td>
		<td><input type="checkbox" value="<?=$row["id"]?>" name="del[]"></td>
		</tr>
		<?php
	}
?>
```
完成後修改下方新增按鈕的連結  
把連結的do改為`<?=$_GET["redo"]?>`，之後複製其他頁面時就不用再改這裡
```php
<input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=n<?=$_GET["redo"]?>&#39;)" value="新增動態文字廣告">
```

## 編輯彈出視窗
在 view.php 加入彈出視窗  
這頁只有新增動態文字廣告
```php
<?php
case "nad":
	?>
	<form enctype="multipart/form-data" method="post" action="api.php?do=<?=$_GET["do"]?>">
	<input type="text" name="text">
	<input type="submit">
	</form>
	<?php
	break;
?>
```

## 寫入API
在 api.php 加入處理表單的程式碼  
```php
case "ad":
	upd($_POST, "ad", 0);
	lo("admin.php?redo=ad");
	break;

case "nad":
	upd($_POST, "ad", 1);
	lo("admin.php?redo=ad");
	break;
```