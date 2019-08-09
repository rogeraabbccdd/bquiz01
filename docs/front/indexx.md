---
description: 編輯首頁index.php
---

# 首頁

## 動畫輪播

### 顯示資料

找到 `<!--正中央-->` ，插入動畫輪播的程式碼

```php
// 因為輪播的JS設計是把所有圖片路徑放入Array()
// 所以我們就把資料串成一串，每個圖片用 , 隔開
$mvim = "";
$result = All(sql("mvim", 1));
foreach($result as $row)
{
	$ani .= "'img/".$row["file"]."',";
}
```

### 修改JS

把變數放入下面的JS

```php
var lin=new Array(<?=$mvim?>);
```

## 最新消息

找到最新消息區，在裡面的 ul 標籤放入程式碼  
首頁最新消息滑入效果的JS有兩個\(alt一個，altt一個\)，但是更多最新消息頁只有altt，因此這部分的j就搭配alt的效果，將li的class設為sswww，等一下做更多最新消息頁時可以直接複製貼上做修改

```php
<?php
	// 設為顯示的最新消息筆數
	$news_num = count(All(sql("news", 1)));
	// 如果大於5筆，顯示More...
	if($news_num > 5) 
	{
		echo "<span style='float:right'><a href='news.php'>More...</a></span>";
	}
?>
<span class="t botli">最新消息區</span>
<ul class="ssaa" style="list-style-type:decimal;">
<?php
	$result = All(sql("news", 1)." limit 5");
	foreach($result as $row)
	{
		// 部分文字
		$part = mb_substr($row["text"], 0, 10, "utf8");
		
		// 下方的Javascript為滑鼠移入時顯示全部文字的效果	
		// li的class必須為sswww，放部分文字	
		// span的class必須為all，放全部文字，且display要設定成none
		echo '<li class="sswww">'.$part.'<span class="all" style="display:none">'.$row["text"].'</span></li>';
	}
?>
</ul>
```

插入程式碼後要把 id 為 altt 的 div 和後面的 Javascript刪掉，否則滑鼠移入時會出現兩個全部文字的框  