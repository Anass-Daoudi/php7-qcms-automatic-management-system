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
    
    #conteneur {
	margin: 0;
	padding: 10px;
    background-color: #FFF;
    position: absolute;
    left: 0px;
    right: 0px;
    top:75px;
}
    a{
    color:#1ab744;
    text-decoration: none;
    display:block;
    width: 100%;
    height: 60px;
}

    #divi2{
       float: right;
       outline : none;
       color:#1ab744;
       border-top:3px solid #1ab744;
        border-radius:5px;
       background-color:#FFF;
    
        }
     #divi1{
            float: right;
        }
    
    </style>
<link rel="stylesheet" type="text/css" href="../css/style3.css" />
<title>Sign Up Student</title>
</head>
<body>
<div id="line1">

        
         <div class="divi" id="divi1">
            <a href="home.php">HOME</a>
        </div >
        <div class="divi" id="divi2">
         Sign Up Student
        </div>
        
    </div>  
	<div id="conteneur">
		<form method="post" action="../controller/SignUpAction.php">
			<fieldset>
				<legend>Sign Up Student</legend>
				<div class="global_bloc">
					<div class="left_bloc">
						<div class="label_class">First Name</div>
						<div class="input_class">
							<input type="text" name="firstName" id="firstName"
								class="input_field"
								value="<?php echo isset($_GET['firstName'])?$_GET['firstName']:"";?>" autofocus/>
						</div>
						<br />
						<div class="label_class">Last Name</div>
						<div class="input_class">
							<input type="text" name="lastName" id="lastName"
								class="input_field"
								value="<?php echo isset($_GET['lastName'])?$_GET['lastName']:"";?>" />
						</div>
						<br />
						<div class="label_class">Birhtday (format: day-month-year)</div>
						<div class="input_class">
							<input type="text" name="birthday" id="birthday"
								class="input_field"
								value="<?php echo isset($_GET['birthday'])?$_GET['birthday']:"";?>" />
						</div>
						<br />
						<div class="label_class">CIN</div>
						<div class="input_class">
							<input type="text" name="cin" id="CIN" class="input_field"
								value="<?php echo isset($_GET['cin'])?$_GET['cin']:"";?>" />
						</div>
						<br />
						<div class="label_class">CNE</div>
						<div class="input_class">
							<input type="text" name="cne" id="CNE" class="input_field"
								value="<?php echo isset($_GET['cne'])?$_GET['cne']:"";?>" />
						</div>
						<br />
					</div>
					<div class="right_bloc">
						<div class="label_class">Choose your field:</div>
						<select name="selection" id="selection">
							<option selected hidden id="filiere">Choose your field :</option>
							<option <?php echo isset($_GET['pc'])?$_GET['pc']:"";?>>PC</option>
							<option <?php echo isset($_GET['svt'])?$_GET['svt']:"";?>>SVT</option>
							<option <?php echo isset($_GET['sma'])?$_GET['sma']:"";?>>SM-A</option>
							<option <?php echo isset($_GET['smb'])?$_GET['smb']:"";?>>SM-B</option>
						</select><br />
						<div class="label_class">Mark</div>
						<div class="input_class">
							<input type="text" name="mark" id="mark" class="input_field"
								value="<?php echo isset($_GET['mark'])?$_GET['mark']:"";?>" />
						</div>
						<br />
						<div class="label_class">Email</div>
						<div class="input_class">
							<input type="text" name="email" id="email" class="input_field"
								value="<?php echo isset($_GET['email'])?$_GET['email']:"";?>" />
						</div>
						<br />
						<div class="label_class">Password</div>
						<div class="input_class">
							<input type="password" name="pass" id="pass" class="input_field"
								value="<?php echo isset($_GET['password'])?$_GET['password']:"";?>" />
						</div>
						<br />
						<div class="label_class">Password Confirmation</div>
						<div class="input_class">
							<input type="password" name="confirmpass" id="confirmpass"
								class="input_field" value="<?php echo isset($_GET['passwordConfirmation'])?$_GET['passwordConfirmation']:"";?>" />
						</div>
						<br />
						<div class="input_class">
							<input type="submit" name="submit" value="Sign Up" id="valid"
								class="input_field" />
						</div>
						<br />
					</div>
				</div>
				<div id="error">
					<font color="red" face="arial" size="4"><?php echo isset($_GET['error'])?$_GET['error']:"";?></font>
				</div>
			</fieldset>
		</form>
	</div>
	<script src="../js/jquery.js"></script>
    <script src="../js/professorHome.js"></script>
</body>
</html>