<?php
		$username1=htmlspecialchars($_POST["username1"],ENT_QUOTES);
    $password1=htmlspecialchars($_POST["password1"],ENT_QUOTES);
		//fileの書き込み
		$filename="./list.csv";
		$dest="./secret.php";
		$cku="user";
		if(strcmp($username1,"")==0||strcmp($password1,"")==0)
			exit("ERROR:usernameまたはpasswordが空白です");
		if(!file_exists($filename))
			exit("登録されてない");
		
		$fp=fopen($filename,"r");
		flock($fp, LOCK_EX);
		$flag=false;
		while($line=fgetcsv($fp))
			if(strcmp($line[0],$username1)==0 && strcmp($line[1],hash("md5",$password1))==0){
				$flag=true;
				break;
			}
		flock($fp, LOCK_UN);
		fclose($fp);
		if($flag){
			setcookie("$cku","$username1",time()+30);
			header("HTTP/1.1 301 Moved Permanently");
			header("Location:$dest");
			exit();
		}else{
			exit("UsernameまたはPasswordが違います");
		}
?>
