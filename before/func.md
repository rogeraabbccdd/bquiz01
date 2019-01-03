---
description: SQL資料庫"測試"完成後，開始"測試"PHP，寫好共用function以及資料庫連接、session等程式碼
---

# 編寫共用程式碼

## 建立檔案sql.php

建立檔案sql.php，放入共用程式碼

## 寫入必要程式碼

```php
/*** 開啟資料庫連接 ***/
$link = mysqli_connect("localhost", "root", "", "dbxx");
	
/*** 設定UTF8 ***/
mysqli_query($link, "set names utf8");

/* 開始session */
session_start();
```

## 寫入function

由於考試有四個小時的時間限制，將一些常用語法寫成 function 來縮短字數，節省打字時間  
第一題後台資料處理大同小異，因此也可以寫成function，避免修改程式碼漏改

```php
// 節省 mysqli_query 字數
function mq($sql)
{
	global $link;
	return mysqli_query($link, $sql);
}

// 節省 mysqli_fetch_array 字數
function fa($r)
{
	return mysqli_fetch_array($r);
}

// 節省 mysqli_fetch_array 字數，同時代入 $row 變數
function fa2(&$row, $r)
{
	return $row = mysqli_fetch_array($r);
}

// 節省 mysqli_num_rows 字數
function nr($r)
{
	return mysqli_num_rows($r);
}

// 節省 header跳頁 字數
function lo($l)
{
	return header("location:".$l);
}

// 第一題的SQL很有規律，因此寫成function
// 前台顯示加 where display = 1
// 後台則不用(顯示所有資料)
function sql($tb, $dis)
{
	$r = "select * from ".$tb;
	if($dis) 	$r .= " where display = 1";
	
	return $r;
}

// 第一題的更多最新消息頁和一些後台需要分頁功能，所以寫成function
// 分頁sql
// tbl為資料表
// p(page)為目前頁數，l(limit)為一頁筆數，s(show)為判斷是否只查詢顯示
function page($tbl, $p, $l, $s)
{
	global $link;

	// 從第幾筆開始查詢，SQL的limit第一個數字從0開始算
	// "LIMIT 0,5" 代表跳過0筆資料取5筆
	// 頁數 |   SQL LIMIT第一個數字
	//  1   |   1*5-5=0
	//  2   |   2*5-5=5
	$start = $p*$l-$l;

	return sql($tbl, $s)." limit ".$start.", ".$l;
}

// 分頁頁碼
// tbl為資料表
// p(page)為目前頁數，l(limit)為一頁筆數，s(show)為判斷是否只查詢顯示
// redo為原頁面的redo變數(第一題的後台以 redo 判斷顯示哪個管理項目)
function pagelink($tbl, $p, $l, $s, $redo)
{
	global $link;

	// 把要顯示的東西串在一個變數裡 return
	$r = "";

	// 總頁數
	$result = mq(sql($tbl, $s));
	$tp = ceil(nr($result) / $l);

	// 下一頁
	$np = $p+1;
	if($np > $tp)	$np = $tp;

	// 上一頁
	$lp = $p-1;
	if($lp < 1)		$lp = 1;

	// 上一頁的箭頭
	$r .= '<a class="bl" style="font-size:30px;" href="?p='.$lp.'&redo='.$redo.'"">< </a>';

	// 頁碼
	for($i=1; $i<=$tp; $i++)
	{
		if($i == $p)	$r.= '<a class="bl" style="font-size:50px;" href="?do=meg&p='.$i.'&redo='.$redo.'">'.$i.'</a>';
		else	$r.= '<a class="bl" style="font-size:30px;" href="?do=meg&p='.$i.'&redo='.$redo.'">'.$i.'</a>';
	}

	// 下一頁的箭頭
	$r .= '<a class="bl" style="font-size:30px;" href="?p='.$np.'&redo='.$redo.'"> ></a>';

	return $r;
}
```

## 寫入session控制

```php
// 進站人數
// 以 $_SESSION["v"] 判斷是否已經算過人數
if(empty($_SESSION["v"]))
{
	// 隨便給值，不是空值就好
	$_SESSION["v"] = "123";
	
	// 資料庫更新人數
	mq("update visit set count = count + 1");
}

// 管理登入按鈕
// 以 $_SESSION["a"] 判斷是否登入
if(empty($_SESSION["a"]))
{
	$btn = "管理登入";
	$btnh = "login.php";
}
else
{
	$btn = "回後台管理";
	$btnh = "admin.php";
}
```

