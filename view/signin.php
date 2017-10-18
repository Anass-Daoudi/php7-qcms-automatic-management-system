<?php
session_start ();
if (isset ( $_SESSION ['professor'] )) {
	echo "test";
	header ( 'location:/project/view/professorhome.php' );
	exit ();
} else if (isset ( $_SESSION ['student'] )) {
	header ( 'location:/project/view/studenthome.php' );
	exit ();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<style>
#conteneur_authentification {
	margin: 0;
	padding: 10px;
	/*background:linear-gradient(to bottom,#DDDDDD,#FFFFFF); */
	background-color: #FFF;
	position: absolute;
	top: 75px;
	left: 0px;
	right: 0px;
}

#line1 {
	background-color: #EEE;
	position: absolute;
	right: 0px;
	left: 0px;
	top: 10px;
}

#menu {
	width: 80%;
	height: 40px;
	/*border:1px solid black;*/
	margin: auto;
	display: flex;
	padding-bottom: 20px;
	/* margin-top: 10px;*/
}

.divi {
	font-family: dayrom;
	font-size: 20px;
	width: 25%;
	height: 40px;
	text-align: center;
	padding-top: 20px;
	color: #78909c;
}

.divi:hover {
	background-color: dodgerblue;
	color: aliceblue;
}

#divi1 {
	float: right;
}

a {
	color: #1ab744;
	text-decoration: none;
	display: block;
	width: 100%;
	height: 60px;
}

a:hover {
	color: aliceblue;
}

#divi2 {
	float: right;
	outline: none;
	color: #1ab744;
	border-top: 3px solid #1ab744;
	border-radius: 5px;
	background-color: #FFF;
}
</style>
<link rel="stylesheet" type="text/css" href="../css/authentication.css" />
<title>Sign In</title>
</head>
<body>
	<div id="line1">


		<div class="divi" id="divi1">
			<a href="home.php">HOME</a>
		</div>
		<div class="divi" id="divi2">Sign In</div>


	</div>
	<div id="conteneur_authentification">
		<form method="post" action="../controller/SignInAction.php">
			<fieldset class="fildset_authentification">
				<legend>Sign In</legend>
				<div class="input_class">
					<input type="text" name="email" id="Email" placeholder="Email"
						class="input_field" />
				</div>
				<br />
				<div class="input_class">
					<input type="password" name="pass" id="pass" placeholder="Password"
						class="input_field" />
				</div>
				<br />
				<div align="center">
					<div class="input_class">
						<input type="submit" name="submit" value="Sign In" id="valid"
							class="input_field" />
					</div>
					<div id="error">
						<font color="red" face="arial" size="4"><?php echo isset($_GET['error'])?$_GET['error']:"";?></font>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<script src="../js/jquery.js"></script>
	<script src="../js/professorHome.js"></script>
</body>
</html>