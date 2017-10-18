<?php
require_once '../model/Student.php';
session_start ();

if (! isset ( $_SESSION ['student'] )) {
	header ( 'location:/project/view/home.php' );
	exit ();
}

$student = $_SESSION ['student'];
// echo "Hello " . $student->getFirstName () . ' ' . $student->getLastName ();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<style>
#display1 {
	margin-top: 100px;
}

.inputStudent {
	width: 100%;
	font-family: dayrom;
	font-size: 20px;
	height: 40px;
	text-align: center;
	color: #78909c;
	position: relative;
	border: none;
	background-color: #EEE;
	outline: none;
	padding-bottom: 40px;
}

.inputStudent:hover {
	background-color: dodgerblue;
	color: aliceblue;
}
</style>
<link rel="stylesheet" type="text/css" href="../css/studenthome.css" />
<script type="text/javascript" src="../js/xhr.js"></script>
<script type="text/javascript" src="../js/disconnect.js"></script>
<script type="text/javascript">
function passContest(idStudent,qcmYear){
	xhr=getxhr();
	xhr.open("POST","../controller/DisplayQCMStudent.php",true);
	xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); 
	xhr.send("idStudent="+idStudent+"&qcmYear="+qcmYear);
	xhr.onreadystatechange=function (){
		if(xhr.readyState==4 && xhr.status==200){
			document.getElementById("display1").innerHTML=xhr.responseText;
		}
	}
}
function getResult(){
	xhr=getxhr();
	xhr.open("POST","../controller/StudentResultAction.php",true);
	xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); 
	xhr.send("qcmYear="+document.getElementById("qcmYear").value);
	xhr.onreadystatechange=function (){
		if(xhr.readyState==4 && xhr.status==200){
			document.getElementById("display").innerHTML=xhr.responseText;
		}
	}
}

function myResultsYear(){
	xhr=getxhr();
	xhr.open("GET","StudentResultView.php",true); 
	xhr.send("null");
	xhr.onreadystatechange=function (){
		if(xhr.readyState==4 && xhr.status==200){
			document.getElementById("display1").innerHTML=xhr.responseText;
		}
	}
}
</script>
<title>Student Home</title>
</head>
<body>
	<div id="line1">
		<div id="menu">

			<div class="divi" id="divi1">
            <?php echo "Hello " . $student->getFirstName () . ' ' . $student->getLastName (); ?>
        </div>
			<div class="divi" id="divi2">
				<input type="button" id="input2" class="inputStudent"
					onClick="passContest(<?php echo $student->getId();?>,<?php echo date("Y");?>)"
					value="Pass The Contest <?php echo date("Y")?>" />
			</div>

			<div class="divi" id="divi3">
				<input type="button" id="input3" class="inputStudent"
					onClick="myResultsYear()" value="Get My Results" />
			</div>

			<div class="divi" id="divi4">
				<input type="button" value="Disconnect" id="disconnect"
					onClick="disconnect()" />
			</div>
			<!--   <div id="logoutg">-->
			<!--<div class="divi" id="divi4">
            <input id="input4" class="inputProf" type="button" value="Disconnect" onClick="disconnect()" />
        </div>-->

		</div>

	</div>
	<!--<input type="button" value="Actulise For This Year Contest" />-->
	<div align="center" id="display1"></div>
	<script src="../js/jquery.js"></script>
	<script src="../js/professorHome.js"></script>
</body>
</html>
<!--home passContest disconnect myResult-->