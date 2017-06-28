<?php 
	
	if(isset($_POST["name"]))
		$name=htmlspecialchars($_POST["name"]);
	else
		$name="no name1";
	date_default_timezone_set('Asia/Tokyo');
	$time=date("Y/m/j H:i:s");

	$content=isset($_POST["content"])?htmlspecialchars($_POST["content"]):null;
	$content=preg_replace("<\n>","<br>",$content);
	
	$fp=fopen("./log.csv","a");
	flock($fp,LOCK_EX);
	$line=$name.",".$time.",".$content."\n";
	fputs($fp,$line);
	flock($fp,LOCK_UN);
	fclose($fp);
?>
<!DOCTYPE html>
<html lang=ja>
<head>
	<title>投稿を受け付けました</title>
	<meta charset="utf-8">
</head>
<body>
	<header>
		<h1>投稿内容</h1>
	</header>
<?php 
	echo "<p><b>氏名:".$name."</b> 投稿日時:<time>".$time."</time><br>".$content."</p>";
?>

	<hr>
	<p>
		<a href="./view.php" target="_self">掲示板に戻る</a><br>
		<a href="./index.html" target="_self">トップに戻る</a>
	</p>
	<footer>
		<p><small>&copy; copyright 2222 god bless us :)</small></p>
	</footer>
</body>
</html>
