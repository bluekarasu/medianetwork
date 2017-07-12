<?php
	$username=htmlspecialchars($_POST["username"]);
	$password=htmlspecialchars($_POST["password"]);
	$confirmpassword=htmlspecialchars($_POST["confirm-password"]);
	if(strcmp($username,"")==0||strcmp($password,"")==0||strcmp($confirmpassword,"")==0)
		exit("error:usernameまたはpasswordが空白です");

	//fileの書き込み
	$filename="./list.csv";
	if(!file_exists($filename))
		touch($filename);

  if($password==$confirmpassword){
    $fp=fopen($filename,"r+");
    flock($fp, LOCK_EX);
		$flag=false;
			            					//IDの重複確認を行うために
		while($line = fgetcsv($fp)){
			if(strcmp($line[0],$username)==0){
				$flag=true;
				break;
			}

		}
		if($flag==true){
			exit("登録されているusernameです");
		}else{
			fputcsv($fp,Array($username, hash("md5",$password)));
			
		}
    flock($fp, LOCK_UN);
    fclose($fp);

	}else{
		exit("error:passwordが合わない");
	}
?>

<!DOCTYPE html>
<html lang='ja'>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
      body {background-color: rgb(77, 156, 221);}
      h1   {color: blue;}
			.touroku{
				padding-top: 300px ;
			}
    </style>
	</head>
	<body>
		<header>
      <div class="text-center touroku">
			     <h1>登録ありがとうございます</h1>
			         内容は以下の通りです。
      </div>
		</header>
    <div class="text-center">
		    <p>
			       username: <?php echo $username ?><br>
			       password:<?php echo $password ?><br>
             ホームページへ戻って、ログインしてください。<br />
		   </p>
			 <a href="./index.html" target="_self">登録画面へ戻る</a>
   </div>
	 <footer class="text-center">
		 <p><small>&copy; copyright by tumka </small></p>
	 </footer>
	</body>
</html>
