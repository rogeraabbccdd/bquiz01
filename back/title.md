---
description: 編輯atitle.php
---

# 標題管理

## 編輯表單

### 編輯 form 標籤

把 form 標籤的`target="back"` 刪除，然後把action改為 api.php

```html
<form method="post" action="api.php?do=tii">
```

### 顯示後台資料

表格第一列標題列後面放入顯示資料的程式碼
版型預設按鈕會以彈出視窗顯示 view.php，以 do 判斷要顯示的內容  
我的do命名規則是新增以n(new)開頭，修改以u開頭(update)，後面接admin.php的redo，不過因為標題管理沒有redo，所以直接寫title
```php
<?php
	$result = All(sql("title", 0));
	foreach($result as $row)
	{
		?>
			<tr>
				<input type="hidden" name="id[]" value="<?=$row["id"]?>">
				<td>
					<img src="img/<?=$row["file"]?>" width="400">
				</td>
				<td>
					<input type="text" value="<?=$row["text"]?>" name="text[<?=$row["id"]?>]">
				</td>
				<td>
					<input type="radio" value="<?=$row["id"]?>" name="display" <?=($row["display"])?"checked":""?>>
				</td>
				<td>
					<input type="checkbox" value="<?=$row["id"]?>" name="del[]">
				</td>
				<td>
					<input type="button" onclick="op('#cover','#cvr','view.php?do=uptitle&id=<?=$row["id"]?>')" value="更新圖片">
				</td>
			</tr>
		<?php
	}
?>
```
完成後修改下方新增按鈕的連結  

```html
<input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=ntitle&#39;)" value="新增網站標題圖片">
```

## 編輯彈出視窗
標題管理有title和uptitle兩個要顯示

開新檔view.php，以 `$_GET["do"]` 判斷要做什麼動作  
因為這題後台幾乎都有彈出視窗，建議用 `switch` 節省字數

```php
<?php
	include_once "sql.php";

	switch($_GET["do"])
	{
		// 上傳圖片
		case "uptitle":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=uptitle&id=<?=$_GET["id"]?>">
			<input type="file" name="file">
			<input type="submit">
			</form>
			<?php
			break;

		// 新增標題
		case "title":
			?>
			<form enctype="multipart/form-data" method="post" action="api.php?do=ntitle">
			<input type="file" name="file">
			<input type="text" name="text">
			<input type="submit">
			</form>
			<?php
			break;
	}
?>
```

## 寫處理表單資料的function

在 sql.php 加入處理表單的function  
因為這題的檔案上傳都是單檔上傳，且有些地方只要處理檔案，不用處理表單，所以我分成兩個function  
要注意的地方是foreach沒有收到值的話會跳出警告訊息，不過處理表單後會瞬間跳回管理頁所以看不到，這是為了應付考試才沒有寫判斷
```php
// 處理表單資料
// $post 為 $_POST
// $tbl為資料表
// $insert為是否要新增一筆資料
function upd($post, $tbl, $insert)
{
	global $link; 
	// 如果有要INSERT，先新增一筆只有ID的資料
	$newid = -1;
	if($insert)	
	{
		SQLExec("insert into ".$tbl." (id) values (null);");	
		$newid = $pdo->lastInsertId();
	}

	// 迴圈表單的資料
	// 先迴POST的NAME
	foreach($post as $name => $v)
	{
		// 有些資料不是陣列
		if(!is_array($v))
		{
			switch($name){
				// title的display
				case "display":
					SQLExec("update ".$tbl." set display = 1 where id = ".$v);
					break;

				// footer、進站人數
				case "bottom":
				case "count":
					SQLExec("update ".$tbl." set ".$name." = '".$v."'");
					break;
				
				// 新增文字廣告、新增最新消息、新增管理員、新增主選單
				default:
					SQLExec("update ".$tbl." set ".$name." = '".$v."' where id = ".$newid);
					break;
			}
		}
		else
		{
			// 再迴每個NAME的陣列，陣列索引值為資料ID
			foreach($v as $id => $vv)
			{
				switch($name)
				{
					// 有傳ID的東西設為不顯示
					case "id":
						SQLExec("update ".$tbl." set display = 0 where id = ".$vv);
						break;

					// 再把要顯示的設為顯示
					case "display":
						if($insert) $vv = $newid;
						SQLExec("update ".$tbl." set display = 1 where id = ".$vv);
						break;

					case "del":
						SQLExec("delete from ".$tbl." where id = ".$vv);
						break;
					
					// 文字、管理者帳號及密碼、選單文字及連結
					default:
						if($insert) $vv = $newid;
						SQLExec("update ".$tbl." set ".$name." = '".$vv."' where id = ".$id);
						break;					
				}
			}
		}
	}

	// 回傳新增資料的ID，如果沒有新增資料則回傳-1
	return $newid;
}

// 處理上傳檔案
function upfile($file, $tbl, $id)
{
	// 以目前的時間戳記當檔案名稱
	$date = strtotime("now");

	// 獲取上傳檔案的副檔名
	$ext = pathinfo($file["file"]["name"], PATHINFO_EXTENSION);

	// 組合成完整的檔名
	$name = $date.".".$ext;
	
	copy($file["file"]["tmp_name"], "img/".$name);
	
	SQLExec("update ".$tbl." set file = '".$name."' where id = '".$id."'");
}
```

## 寫入API
在 api.php 加入處理表單的程式碼  
直接套入剛剛寫好的function
```php
case "title":
	upd($_POST, "title", 0);
	lo("admin.php");
	break;

case "uptitle":
	upfile($_FILES, "title", $_GET["id"], "");
	lo("admin.php");
	break;

case "ntitle":
	$nid = upd($_POST, "title", 1);
	upfile($_FILES, "title", $nid);
	lo("admin.php");
	break;
```