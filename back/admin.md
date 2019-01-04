---
description: 編輯後台頁admin.php
---

# 後台頁

## 管理登出

### 修改連結

找到管理登出鈕，把 onclick 裡面的`location.replace`路徑改為 api.php，讓 api.php 做登出處理

```php
onclick="document.cookie=&#39;user=&#39;;location.replace(&#39;api.php?do=out&#39;)" style="width:99%; margin-right:2px; height:50px;"
```

### 處理登出

編輯api.php

```php
// 登出
case "out":
    // 只有 unset 管理員的 session
    // 避免進站人數因為 session_destroy 或 session_unset 而 +1
    unset($_SESSION["a"]);
    // 導回登入頁
    lo("login.php");
    break;
```

## 內容區

這頁的選單連結以 `$_GET["redo"]` 判斷在內容區顯示的管理項目

找到`<p class="t cent botli">網站標題管理</p>` ，把包住它的div裡面的內容全部剪下，另開新檔 `atitle.php` 後貼上，然後在後面加上 include 程式碼

修改完成後的整段程式碼如下

```php
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
<?php
    // 選單連結以 redo 判斷要在網頁內容區顯示哪個管理項目
    // 預設為 標題管理
    // 直接 include 檔名為redo值的php 就好
    // 不過要在前面加個 a ，避免和前台頁面衝突，例如更多最新消息頁
    if(empty($_GET["redo"]))	include "atitle.php";
    else 	include "a".$_GET["redo"].".php";	
?>
</div>
```

