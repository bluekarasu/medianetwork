<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>掲示板</title>
	<style type="text/css">
		body {background-color: powderblue;}
		h1   {color: blue;}
		form {background-color: white;}
	</style>
</head>
<body>
<header>
	<h1>掲示板</h1>
</header>
<hr>
<p>
	<b>投稿フォーム</b>
	<form method="POST" action="./post.php">
		氏名:<input type="text" name="name"><br>
		内容:<br>
		<textarea name="content" ></textarea><br>
		<input type="submit" value="投稿">		
	</form>
</p>
<hr>
<?php 
	$name=array();
	$time=array();
	$cont=array();
	if(is_file("./log.csv")){
		if(is_readable("./log.csv")){
			$fp=fopen("./log.csv","r");
			flock($fp,LOCK_SH);
			$count=1;
			
			while(!feof($fp)){
				$line=fgets($fp);
				$content=explode(",",$line);
				if(count($content)==3){
					array_push($name,$content[0]);
					array_push($time,$content[1]);
					array_push($cont,$content[2]);
					$count++;
				}
				
			};
			for($i=$count ; $i>0 ; $i--){
				
				$timez=array_pop($time);
				$namez=array_pop($name);
				$contz=array_pop($cont);
				echo "<p>".$i;
				echo ":<strong>氏名:$namez</strong>";
				echo "日時:<time>$timez</time><br>$contz</p>\n";
				echo "<hr>\n";
				
			}
			flock($fp,LOCK_UN);
			fclose($fp);
		}
		else
			echo "ファイル開けません";
	}
	else
		echo "誰もしていません";
?>
</body>
</html>
		
