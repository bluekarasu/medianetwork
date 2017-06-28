<?php
	if(is_readable("./result.csv") && $fp=fopen("./result.csv","r")){
		flock($fp,LOCK_SH);
		
		$cnt["ct"]=0;
		$cnt["cc"]=0;
		$cnt["sh"]=0;
		$in=0;
		while($csvline=fgets($fp)){
			$data=explode(",",trim($csvline,"|n"));
			if(count($data)==3){
				$menu=(string)$data[2];
				if(isset($cnt[$menu]))
					$in++;
					$cnt[$menu]++;
				
			}
		}
		flock($fp,LOCK_UN);
	}else{
		exit("csv error");
	}

?>	
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>アンケート結果</title>
			<script type=”text/javascript” src="./html5jp/graph/circle.js">
				window.onload=function(){
					var cg=new html5jp.graph.circle("sample");
					if(! cg){ return;}
					var items=[
						["チキンおろしだれ", <?php echo $cnt["ct"]?> ],
						["チキンおろしだれ", <?php echo $cnt["cc"]?> ],
						["チキンおろしだれ", <?php echo $cnt["sh"]?> ],
					];
					cg_draw(items);
				};
			</script>
		<style type="text/css">
			body {background-color: powderblue;}
			h1   {color: blue;}
			.chyui {color :red;}
		</style>
	</head>

	<body">
		<?php if(is_readable("./result.csv")): ?>
		<header>
			<h1>みんなの好きなメニュー</h1>
			現時点出のアンケート結果です。

		</header>
		<p>
			商品名、得票数,割合<br>
			チキンおろしだれ <?php echo $cnt["ct"]?><br>
			クリームチーズ <?php echo $cnt["cc"]?><br>
			カツカレー <?php echo $cnt["sh"]?><br>
		</p>
		<p >
			<a href="./index.html" target="_self">フォームに戻る</a><br>
			<div><canvas width="450" height="300" id="sample"></canvas></div>
			
		</p>
		
		<?php else: ?>
			<p>fileがありません。</p>
		<?php endif; ?>	
		<footer>
			<p><small>&copy; copyright </small></p>
		</footer>
	</body>
</html>
