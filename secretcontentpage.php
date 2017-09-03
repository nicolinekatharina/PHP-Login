<?php session_start(); ?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body><center>
<?php
	if(empty($_SESSION['uid'])){
		echo 'Du skal være logget ind for at se indholdet.';
	}
	else {
		echo 'Velkommen '.$_SESSION['username'].'<br> Det hemmelige kodeord er: MulA_lov3s_c4ts';
		echo '<br><br><img src="https://coffeecurls.files.wordpress.com/2015/03/screen-shot-2015-03-14-at-16-40-09.png" alt="Mountain View" style="width:304px;height:228px;">
<img src="https://coffeecurls.files.wordpress.com/2015/03/screen-shot-2015-03-14-at-16-40-09.png" alt="Mountain View" style="width:304px;height:228px;">
<img src="https://coffeecurls.files.wordpress.com/2015/03/screen-shot-2015-03-14-at-16-40-09.png" alt="Mountain View" style="width:304px;height:228px;">';
		echo '<br><br><button a href="">Log ud</button>';
	}
?>
<br>
<br>
	</center>
</body>
</html>