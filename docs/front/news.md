---
description: 編輯更多最新消息頁news.php
---

# 更多最新消息頁

## 判斷頁數

以 `$_GET["p"]` 判斷目前頁數，所以在頁首輸入

```php
$p = 1;
if(!empty($_GET["p"]))	$p = $_GET["p"];
```

## 顯示最新消息

已經把分頁功能寫成function了，所以直接套用就好  
找到 `<!-- 正中央 -->` 後面的 div ，在裡面插入程式碼

```php
<!-- 
	設定OL開始數字為 頁碼*5-4 
	頁碼		| 開始數字
	1		| 1
	2		| 6
	3		| 11
-->
<ol style="list-style-type:decimal;" start="<?=($p*5-4)?>">
	<?php
		// 分頁SQL
		$sql = page("news", $p, 5, 1);
		$result = All($sql);
		foreach($result as $row)
		{
			// 這裡和首頁一樣寫法
			$part = mb_substr($row["text"], 0, 20, "utf8");
			?>
				<li class="sswww"><?=$part?><span class="all" style="display:none"><?=$row["text"]?>?</span></li>
			<?php
		}
		
		// 頁碼function
		echo pagelink("news", $p, 5, 1, "");
	?>
</ol>
```