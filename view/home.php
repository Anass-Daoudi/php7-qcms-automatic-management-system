
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
<style>
#homeImage1{
	position:relative;
	top:50px;
    margin-left:450px;
}
#divTop{
        display: flex;
        /* border:1px solid black;*/
         position:relative;
        top:100px;
        
    }
#homeImage3{
   /*position:absolute;
   left:10px;
    top:100px;
   display:inline-block;
  */
    float: left;
    position:relative;
    left:50px;
}

#homeImage2{
/*    border:1px solid black;*/

  /*display:inline-block;*/
  float:right;
    position:relative;
    left:600px;
   /* position: relative;
    top:100px;*/
  
}


</style>
<meta charset="utf-8" />
<style>
#homeImage1{
	position:relative;
	top:400px;
   margin:auto;
}

#homeImage3{
   position:absolute;
   left:10px;
   display:inline-block;
  
}

#homeImage2{
/*    border:1px solid black;*/

  display:inline-block;
  float:right;
  
}


</style>
<link rel="stylesheet" href="../css/home.css" />
<link rel="stylesheet" href="../css/professorHome.css" />
<title>Home</title>
</head>
<body>

	<div id="line1">
		<div id="menu">

			<div class="divi" id="divi1">
				<a href="">HOME</a>
			</div>

			<div class="divi" id="divi2">
				<a href="signin.php">Sign In</a>
			</div>

			<div class="divi" id="divi3">
				<a href="signupprofessor.php">Sign Up Professor</a>
			</div>
			<div class="divi" id="divi4">

				<a href="signup.php">Sign Up Student</a>
			</div>

		</div>
	</div>
    <div id="divTop">
	<div id="homeImage3">
			<img src="../images/marrakech.png">
	</div>
		
	<div id="homeImage2">
			<img src="../images/Universit%C3%A9-Cadi-Ayyad.jpg">
	</div>
                
    </div>
	
	<div id="homeImage1">
			<img src="../images/qcm3.jpg">
    </div>
		<!-- <div id="homeText1">le but de notre site est de generer des QCMs par
			des professeurs</div> -->
	
	
		
<!-- 		<div id="homeText2"></div> -->
		
	
	<script src="../js/jquery.js"></script>
	<script src="../js/professorHome.js"></script>




</body>
</html>