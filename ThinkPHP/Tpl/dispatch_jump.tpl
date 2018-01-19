<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>	
<head>
    
    <title>提示信息</title>
	
    <style type="text/css">
	*{padding:0; margin:0; font:12px/1.5 Microsoft Yahei;}
	a:link,a:visited{text-decoration:none;color:#000}
	a:hover,a:active{color:#ff6600;text-decoration: underline}
	.showMsg{background: #fff; zoom:1; width:450px;position:absolute;top:44%;left:50%;margin:-87px 0 0 -225px;border-radius: 2px;box-shadow: 1px 1px 50px rgba(0,0,0,.3);}
	.showMsg h5{padding: 17px 15px;color:#fff;background: #2DA1E7;font-size:16px;border-radius: 2px;}
	.showMsg .content{padding: 45px;line-height: 24px;word-break: break-all;overflow: hidden;font-size: 14px;overflow-x: hidden;overflow-y: auto;}
	.showMsg .bottom{padding: 10px;text-align: center;border-top: 1px solid #E9E7E7;}
	/*.showMsg .ok,.showMsg .guery{background: url(/Public/Admin/images/msg_bg.png) no-repeat;}*/
	.showMsg .guery{background-position: left center;background-size: 40px;}
	</style>
	
</head>
<body>
<div class="showMsg" style="text-align:center">
	<h5>提示信息</h5>
	<div class="content guery" style="display:inline-block;display:-moz-inline-stack;zoom:1;*display:inline; max-width:280px"><?php 
		if(isset($message)) {
			echo($message);
		}else{
			echo($error); 
		}
	 ?>
	</div>
	 <div class="bottom">
		
			<p> 
			页面将在<span id="wait" style="color:red; font-weight:bold;margin:0 5px;"><?php echo($waitSecond); ?></span>秒后
			<a id="href" style="color:red;" href="<?php echo($jumpUrl); ?>">跳转</a>...</p>
		
			<p><a href="javascript:history.back(-1)" title="点击返回上一页">点击返回上一页</a></p>
		
	 </div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>