<?php
	if(strlen($_POST["name"])!=0){
		$name=htmlspecialchars($_POST["name"],ENT_QUOTES);
		$course=$_POST["course"];
		$menu=$_POST["menu"];
		//fileの書き込み
		$fp=fopen("./result.csv","a+");
		
		flock($fp, LOCK_EX);
		$output=join(",",array($name,$course,$menu))."\n";
		fputs($fp, $output);
		flock($fp, LOCK_UN);
		fclose($fp);
	}
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>アンケート受付終了</title>
		<style type="text/css">
			body {background-color: powderblue;}
			h1   {color: blue;}
			.chyui {color :red;}
		</style>
	</head>

	<body>
		<?php if(strlen($_POST["name"])!=0): ?>
		<header>
			<h1>回答ありがとうございました</h1>
			回答の内容は以下の通りです。
		</header>
		<p>
			氏名: <?php echo $name ?><br>
			コース名:<?php echo $course ?><br>
			メニュー名 <?php echo $menu ?><br>
		</p>
		<p id="chyui">注意<br></p>
		<p>
			コース名:md(メディア情報学),mn(経営情報学),sc(セキュリティ情報学)<br>
			メニュー名:ct(チキンおろしだれ),cc(クリームチーズメンチカツ),sh(カツカレー) <br>
		</p>
		<p>
			<a href="./result.php">アンケート集計結果を</a><br>
			<a href="./index.html">フォームを見る</a><br>
		</p>
		<?php else: ?>
			<p>アンケートが不備なようです。アンケート入力画面へ戻って再入力をお願いします</p>
		<?php endif; ?>	
		<footer>
			<p><small>&copy; copyright </small></p>
		</footer>
	</body>
</html>
