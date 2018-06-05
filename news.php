<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include "sql.php";
	include "auth.php";
?>
<!-- saved from url=(0055)?do=meg -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>卓越科技大學校園資訊系統</title>
<link href="./assets/css.css" rel="stylesheet" type="text/css">
<script src="./assets/jquery-1.9.1.min.js"></script>
<script src="./assets/js.js"></script>
</head>

<body>
<div id="cover" style="display:none; ">
	<div id="coverr">
    	<a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;" onclick="cl(&#39;#cover&#39;)">X</a>
        <div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
    </div>
</div>
<iframe style="display:none;" name="back" id="back"></iframe>
	<div id="main">
    	<a title='<?=$title_text?>' href='./index.php'><div class='ti' style='background:url(&#39;img/<?=$title_pic?>&#39;); background-size:cover;'></div><!--標題--></a>
    	<div id="ms">
             	<div id="lf" style="float:left;">
            		<div id="menuput" class="dbor">
                    <!--主選單放此-->
                    	                            <span class="t botli">主選單區</span>
													<?=$menu?>
                                                </div>
                    <div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
                    	<span class="t">進站總人數 : 
                        	<?=$visit?>                         </span>
                    </div>
        		</div>
                <div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
                	                     <marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
                    	                   <?=$advert?> </marquee>
                    <div style="height:32px; display:block;"></div>
                                        <!--正中央-->
                        <div style="text-align:center;">
						更多最新消息顯示區
						<?php
							if(!isset($_GET["p"]))	$page = 1;
							else $page = $_GET["p"];
							$start = $page*5-5;
							$ol = $start +1;
						?>
						<ol start=<?=$ol?> class="ssaa" style="text-align:left;">
						<?php
							$result = mysqli_query($link, "select * from news");
							$total = mysqli_num_rows($result);
							
							$result = mysqli_query($link, "select * from news order by id limit ".$start.", 5");
							
							$totalp = ceil($total/5);
							while($row = mysqli_fetch_array($result))
							{
								$part_text = mb_substr($row["text"],0,20 );
								echo "<li>".$part_text."<span class='all' style='display:none'>".$row["text"]."</span></li>";
							}
						?>
						</ol>	
						<?php						
							$lp = $page -1;
							$np = $page +1;
							
							if($lp<1)	$lp = 1;
							if($np>$totalp)	$np = $totalp;
							echo '<a class="bl" style="font-size:30px;" href="?p='.$lp.'"><</a>';
							
							for($i = 1; $i<=$totalp; $i++)
							{
								if($i != $page)
									echo '<a class="bl" style="font-size:30px;" href="?p='.$i.'">'.$i.'</a>';
								else
									echo '<a class="bl" style="font-size:50px;" href="?p='.$i.'">'.$i.'</a>';
							}
							
							echo '<a class="bl" style="font-size:30px;" href="?p='.$np.'">></a>';
						?>
    </div>
	                </div>
                <div id="altt" style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
                    	<script>
						$(".ssaa li").hover(
							function ()
							{
								$("#altt").html("<pre>"+$(this).children(".all").html()+"</pre>")
								$("#altt").show()
							}
						)
						$(".ssaa li").mouseout(
							function()
							{
								$("#altt").hide()
							}
						)
                        </script>
                                 <div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left; ">
                	<!--右邊-->   
                	<button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;" onclick="lo(&#39;<?=$login_url?>&#39;)"><?=$login_text?></button>
                	<div style="width:89%; height:480px;" class="dbor">
                    	<span class="t botli">校園映象區</span>
						<?=$gallery?>
						                        <script>
                        	var nowpage=0,num=<?=$gallery_num?>;
							function pp(x)
							{
								var s,t;
								if(x==1&&nowpage-1>=0)
								{nowpage--;}
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
                    </div>
                </div>
                            </div>
             	<div style="clear:both;"></div>
            	<div style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
                	<span class="t" style="line-height:123px;"><?=$footer?></span>
                </div>
    </div>

</body></html>