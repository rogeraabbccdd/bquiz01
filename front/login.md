---
description: 編輯登入頁login.php
---

# 登入頁

## 編輯表單

找到 `<!-- 正中央 -->` 後面的 form 標籤 ，把 `target="back"` 刪掉  
把 action 改為 `action="api.php?do=check"`

## 建立表單處理檔

建立表單處理檔api.php，以 `$_GET["do"]` 判斷要做什麼動作  
因為這題後台量很大，建議用 `switch` 節省字數

```php
<?php
	// 引用共用檔
	include "sql.php";
	
	// 以 $_GET["do"] 判斷要做什麼動作
	switch($_GET["do"])
	{
		// 處理表單的程式碼 
	}
?>
```

## 處理登入表單資料

在 api.php 新增處理登入表單的程式碼

```php
case "check":
	// 查詢帳號密碼
	$result = All(sql("admin", 0)." where acc = '".$_POST["acc"]."' and pass = '".$_POST["ps"]."'");

	// 查詢資料筆數
	$num = count($result);

	// 有資料，登入
	if($num > 0)
	{
		$_SESSION["a"] = $result[0]["acc"];
		lo("admin.php");
	}

	// 沒資料，顯示訊息後跳回上一頁
	else echo "<script>alert('帳號或密碼輸入錯誤'); window.history.back();</script>";
	break;
```

