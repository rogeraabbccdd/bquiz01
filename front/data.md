---
description: 將各頁都會用到的標題資料、校園映像等資料寫進共用檔sql.php。
---

# 編輯共用資料

## 標題圖片

四個網頁都需要顯示標題圖片

### 共用程式碼

在 sql.php 輸入共用程式碼

```php
$result = mq(sql("title", 1));
while(fa2($row, $result))
{
	$title = "img/".$row["file"];
	$title_text = $row["text"];
}
```

### 插入各頁面

找到 `<div id="main">` 並更改下一行 a 標籤之中的連結，及後面 `<div id="ti">` 標籤中的style背景

```php
<!-- BEFORE -->
<a title="" href="?">
    <div class="ti" style="background:url('use/'); background-size:cover;"></div><!--標題-->
</a>

<!-- AFTER -->
<a title="<?=$title_text?>" href="index.php">
    <div class="ti" style="background:url(&#39;<?=$title?>&#39;); background-size:cover;"></div><!--標題-->
</a>
```

## 頁尾版權

四個網頁都需要顯示頁尾版權

### 共用程式碼

在 sql.php 輸入共用程式碼

```php
$footer = fa(mq(sql("footer", 0)))[0];
```

### 插入各頁面

找到頁面最下面的 div ，在 span裡放入頁尾版權

```php
<div style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
		<span class="t" style="line-height:123px;"><?=$footer?></span>
</div>
```

## 進站人數

四個網頁都需要顯示進站人數

### 共用程式碼

在 sql.php 輸入共用程式碼。  
這個變數必須要在進站判斷的 `$_SESSION["v"]` 後面，否則人數會少1，重新整理後才正常

```php
$visit = fa(mq(sql("visit", 0)))[0];
```

### 插入各頁面

找到進佔總人數，插入進站人數變數

```php
<span class="t">進站總人數 : <?=$visit?>  </span>
```

## 校園映象

除了 admin.php 以外，其他頁面都需要顯示校園映象

### 共用程式碼

在 sql.php 輸入共用程式碼

```php
// 把資料全部串在一個變數裡，插入時只要插入一個變數就好
// 往上的按鈕, pp為素材提供的JS
$gallery = "<img src='img/01E01.jpg' onclick='pp(1)'><br>";

$result = mq(sql("gallery", 1));

// 圖片數
$gnum = nr($result);

$i = 0;
while(fa2($row, $result))
{
	// 校園映象區的JS必須要class為im，id為ssaa開頭才有效
	$gallery .= "<img src='img/".$row["file"]."' class='im' id='ssaa".$i."' width='150' height='103'>";
	$i++;
}

// 往下的按鈕, pp為素材提供的JS
$gallery .= "<br><img src='img/01E02.jpg' onclick='pp(2)'>";

```

### 插入各頁面

找到校園映象區，在後面插入校園映象變數。  
素材提供的Javascript有問題，顯示時會少，所以要做修改

```php
<span class="t botli">校園映象區</span>
	<?=$gallery?>
<script>
	// 在 num 插入總圖片數 $gnum
	var nowpage=0,num=<?=$gnum?>;
	function pp(x)
	{
		var s,t;
		if(x==1&&nowpage-1>=0)
		{nowpage--;}
		
		/* 
			x=2為下一頁翻頁
			舉例:
			如果圖片數量num為10，目前第一張圖nowpage為8
			8+1<=10-3，9<=7不成立，所以不會翻到下一頁
			必須要修改這行，否則圖片會少
		*/
		if(x==2&&(nowpage+1)<=num-3)
		{nowpage++;}
		$(".im").hide()
		for(s=0;s<=2;s++)
		{
			t=s*1+nowpage*1;
			$("#ssaa"+t).show()
		}
	}
	pp(1)
</script>
```

## 選單

除了 admin.php 以外，其他頁面都需要顯示主選單和次選單  
admin.php的選單素材已經寫好了

### 共用程式碼

在 sql.php 輸入共用程式碼

```php
// 把資料全部串在一個變數裡，插入時只要插入一個變數就好
$menu = "";

// 主選單
$result = mq(sql("menu", 1)." and parent = 0");
while(fa2($row, $result))
{
	// 主選單class必須為素材提供的mainmu才有動態效果
	$menu .= "<div class='mainmu'><a href='".$row["href"]."'>".$row["text"]."</a>";
	
	// 主選單內的次選單
	$result2 = mq(sql("menu", 1)." and parent = '".$row["id"]."'");
	while(fa2($row2, $result2))
	{
		// 次選單class必須為素材提供的mainmu2才有動態效果
		$menu .= "<div class='mainmu2 mw'><a href='".$row2["href"]."' class='mainmu2 mw'>".$row2["text"]."</a></div>";
	}
	
	$menu .= "</div>";
}
```

### 插入各頁面

找到主選單區，插入選單變數

```php
<!--主選單放此-->
<span class="t botli">主選單區</span>
<?=$menu?>
```

## 跑馬燈

除了 admin.php 以外，其他頁面都需要顯示跑馬燈文字

### 共用程式碼

在 sql.php 輸入共用程式碼

```php
// 把資料全部串在一個變數裡，插入時只要插入一個變數就好
$mar = "";
$result = mq(sql("advert", 1));
while(fa2($row, $result))
{
	$mar .= $row["text"]."&emsp;";
}
```

### 插入各頁面

找到 marquee 標籤，插入跑馬燈變數

```php
<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
    <?=$mar?>
</marquee>
```

## 其他

最新消息在首頁和最新消息頁呈現的方式不一樣，所以不用寫入 sql.php  
動畫輪播只有首頁才有，所以也不用寫入 sql.php

## 匯入共用檔

編輯完後，在各頁頁首輸入程式碼，匯入寫好的共用檔

```php
include "sql.php"
```



