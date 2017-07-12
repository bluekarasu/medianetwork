<!DOCTYPE html>
<html lang=ja>
<head>
  <title>Challenge Yourself</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--css and js -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/index.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="./js/ind.js"></script>
</head>
<?php
	function uec_file_get_contents($url){
		$aContext=array(
			'http'=>array(
				'proxy'=> 'tcp://proxy.uec.ac.jp:8080',
				'request_fulluri'=>True,
			),
		);
		$cxContext=stream_context_create($aContext);
		$res=file_get_contents($url,False,$cxContext);
		return $res;
	}
	$url="http://weather.livedoor.com/forecast/webservice/json/v1?city=130010";
	$res=uec_file_get_contents($url);
	$json=json_decode($res,$assoc=true);
	date_default_timezone_set('Asia/Tokyo');
	$day=date("Y-m-d");
	foreach($json["forecasts"]as $key){
		if(strcmp($key["date"],$day)==0){
			$datelabel=$key["dateLabel"];
			$telop=$key["telop"];
			$image=$key["image"]["url"];
			if(isset($key['temperature']['min'])) $min_temp=$key["temperature"]["min"]["celsius"];
			else	$min_temp="--";
			if(isset($key['temperature']['max'])) $max_temp=$key["temperature"]["max"]["celsius"];
			else	$max_temp="--";
			break;
		}
	}
				
?>
  <!--body -->

<body style="height:1500px">
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-navbar">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CY</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active">
        <a href="">Home</a>
      </li>
      <li>
        <a href="#login">login</a>
      </li>
      <li>
        <a href="#">Challenges</a>
      </li>
    </ul>
  </div>
</nav>
<div id="home" class="container-fluid text-center">
	<div class="row">
		<h3>Welcome to my webpage</h3>
		<p>Lets get better together</p>
		<div class="col-md-2 tenki" >
			<?php echo $datelabel ?>の天気<br>
			<?php echo $telop?><br>
			<img src=<?php echo $image; ?> alt=<?php echo $telop;?>><br>
			最高気温:<?php echo $max_temp ?><br>
			最低気温:<?php echo $min_temp ?><br>
		</div>
		<div>
		</div>
	</div>

<section id="login" class="text-center">
  <h3>SELF HELP</h3>
  <p>We love challenge!</p>
  <p>i have created website that challenge yourself and getting better day by day</p>
  <br />
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-login">

        <!--panel-header -->

        <div class="panel-heading">
          <div class="col-md-6">
            <a href="#" class="active" id="login-form-link">Login</a>
          </div>
          <div class="col-md-6">
            <a href="#" id="register-form-link">Register</a>
          </div>
        </div>
<!--panel-body -->

        <div class="panel-body">
          <div class="col-md-12">
<!--LOGIN FORM -->
            <form id="login-form" action="./login.php" method="POST" role="form" style="display:block;">
              <div class="form-group">
                <input type="text" name="username1" id="username1" class="form-control" placeholder="Username" value="" />
              </div>
              <div class="form-group">
                <input type="password" name="password1" id="password1" class="form-control" placeholder="Password" />
              </div>
              <div class="form-group text-center">
                <input type="checkbox" tabindex="3" class="" name="rememberme" id="rememberme" />
                <label for="rememberme">Remember me</label>
              </div>
              <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                  <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log in" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <div class="text-center">
                    <a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </form>
<!--LOGIN FORM END-->
<!--REGISTER FORM -->

            <form id="register-form" action="./regist.php" method="POST" role="form" style="display:none;">
              <div class="form-group">
                  <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" />
              </div>
              <div class="form-group">
                  <input type="password" name="password" id="password" tabindex="1" class="form-control" placeholder="Password" value="" />
              </div>
              <div class="form-group">
                  <input type="password" name="confirm-password" id="confirm-password" tabindex="1" class="form-control" placeholder="Confirm Password" value="" />
              </div>
              <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                  <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now" />
                </div>
              </div>
            </form>

<!--REGISTER FORM  END-->
          </div>
        </div>

      </div>
    </div>

    <div class="col-md-8">
      ABOUT
      <br />
      <img src="image/challenge.jpg" class="img-circle indeximage"/>
    </div>
    </div>
  </div>
</div>

</body>
<footer class="text-center">
  <p><small>&copy; copyright by tumka </small></p>
</footer>
</html>
