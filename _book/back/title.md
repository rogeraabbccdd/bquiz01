---
description: 編輯atitle.php
---

# 標題管理

## 編輯表單

### 編輯 form 標籤

把 form 標籤的`target="back"` 刪除，然後把action改為 api.php

```markup
<form method="post" action="api.php?do=tii">
```

### 顯示後台資料

在表格第一列標題後面

```php
<?php
	$result = mq(sql("title", 0));
	while(fa2($row, $result))
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

## 編輯彈出視窗

版型預設彈出視窗顯示 view.php，以 do 判斷要顯示的內容  
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

## 處理表單資料

在 sql.php 加入處理表單的function

```php
/* 處理表單資料 */
function upd($post, $tbl, $insert, $redo)
{
	global $link; 
	// 如果有要INSERT，先新增一筆只有ID的資料
	$newid = -1;
	if($insert)	
	{
		mq("insert into ".$tbl." (id) values (null);");	
		$newid = mysqli_insert_id($link);
	}

	// 迴圈表單的資料
	// 先迴POST的NAME
	foreach($post as $name => $v)
	{
		// 有些資料不是陣列，例如title的display、新增文字廣告等
		if(!is_array($v))
		{
			switch($name){
				// 新增文字廣告
				case "text":
					mq("update ".$tbl." set ".$name." = ".$v." where id = ".$newid);
					break;
				
				// title的display
				case "display":
					mq("update ".$tbl." set display = 1 where id = ".$v);
					break;
				
				// 其他，footer、進站人數等
				default:
					mq("update ".$tbl." set ".$name." = ".$v);
					break;
			}
		}
		else
		{
			// 再迴每個NAME的陣列
			foreach($v as $id => $vv)
			{
				switch($name)
				{
					case "display":
						if($insert) $vv = $newid;
						mq("update ".$tbl." set display = 1 where id = ".$vv);
						break;

					case "del":
						mq("delete from ".$tbl." where id = ".$vv);
						break;
					
					case "id":
						mq("update ".$tbl." set display = 0 where id = ".$vv);
						break;
					
					case "text":
						if($insert) $vv = $newid;
						mq("update ".$tbl." set text = '".$vv."' where id = ".$id);
						break;
				}
			}
		}
	}

	// 回傳新增資料的ID，如果沒有新增資料則回傳-1
	return $newid;
}

/* 處理檔案上傳 */
function upfile($data, $tbl, $id)
{
	// 以目前的時間戳記當檔案名稱
	$date = strtotime("now");
	// 獲取上傳檔案的副檔名
	$ext = pathinfo($data["file"]["name"], PATHINFO_EXTENSION);
	$name = $date.".".$ext;
	
	copy($data["file"]["tmp_name"], "img/".$name);
	
	mq("update ".$tbl." set file = '".$name."' where id = '".$id."'");
}
```

