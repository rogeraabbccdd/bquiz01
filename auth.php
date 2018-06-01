<?php
	require_once "sql.php";
	
	session_start();
	
	// 如果沒有session visitor，代表是新訪客，訪客人數+1
	if(!isset($_SESSION["visitor"]))
	{
		mysqli_query($link, "update visit set count = count+1");	
		
		// 隨便給SESSION visitor一個值，只是用來判斷訪客人數是否要+1
		$_SESSION["visitor"] = "1";
	}

	// 登入登出
	if(isset($_GET["do"]))
	{
		if($_GET["do"] == "check")
		{
			$result = mysqli_query($link, "select * from admin where acc = '".$_POST["acc"]."' and pass = '".$_POST["ps"]."'");
			$numb = mysqli_num_rows($result);
			if(!empty($numb))
			{
				while($row = mysqli_fetch_array($result))
				{
					$_SESSION["user"] = $row["type"];
				}
				
				header("location:admin.php");
			}
			else echo "<script>alert('帳號或密碼輸入錯誤');</script>";
		}
		elseif($_GET["do"] == "logout")
		{
			unset($_SESSION["user"]);
		}
	}
	
	// 頁面右上角的登入按鈕顯示，使用session user來判斷有沒有登入
	if(!isset($_SESSION["user"]))
	{
		$login_text = "管理登入";
		$login_url = "login.php";
	}
	else
	{
		$login_text = "回後台管理";
		$login_url = "admin.php";
	}
?>