<?php
require_once '../model/Professor.php';
session_start ();

if (! isset ( $_SESSION ['professor'] )) {
	header ( 'location:/project/view/home.php' );
	exit ();
}

$professor = $_SESSION ['professor'];
// echo "Hello " . $professor->getFirstName () . ' ' . $professor->getLastName ();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/professorHome.css" />
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="../js/xhr.js"></script>
<script type="text/javascript" src="../js/disconnect.js"></script>
<script type="text/javascript">
	function createQCM(){
		xhr=getxhr();
		xhr.open("GET","qcm.php",true); 
		xhr.send("null");
		xhr.onreadystatechange=function (){
			if(xhr.readyState==4 && xhr.status==200){
				document.getElementById("display0").innerHTML=xhr.responseText;
			}
		}
	}
	function showMyQCMS(idProfessor){
		xhr=getxhr();
		xhr.open("POST","../controller/ShowQCMSAction.php",true); 
		xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); 
		xhr.send("idProfessor="+idProfessor);
		xhr.onreadystatechange=function (){
			if(xhr.readyState==4 && xhr.status==200){
				document.getElementById("display0").innerHTML=xhr.responseText;
			}
		}
	}

	function validateStudents(){
		xhr=getxhr();
		xhr.open("GET","validateCandidates.php",true); 
		xhr.send("null");
		xhr.onreadystatechange=function (){
			if(xhr.readyState==4 && xhr.status==200){
				document.getElementById("display0").innerHTML=xhr.responseText;
			}
		}
	}

	function get(){ 
		document.getElementById("display1").innerHTML="";
		xhr=getxhr();
		xhr.open("POST","../controller/GetCandidatesAction.php",true);
		xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); 
		xhr.send("qcmYear="+document.getElementById("qcmYear").value);
		xhr.onreadystatechange=function (){
			if(xhr.readyState==4 && xhr.status==200){
				document.getElementById("display").innerHTML=xhr.responseText;
			}
		}
	}
	function validate(idStudent){
		xhr=getxhr();
		xhr.onreadystatechange=function (){
			if(xhr.readyState==4){
				document.getElementById("display1").innerHTML=xhr.responseText;
				get();
				document.getElementById("display4").innerHTML="";
			}else{
				 document.getElementById("display4").innerHTML="<img src='../images/loader.gif' />"; 
			}
		}
		xhr.open("POST","../controller/UpdateStudentAcceptedStatusAction.php",true);
		xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); 
		xhr.send("idStudent="+idStudent);	
	}
	function displayQCM(idQCM){
		xhr=getxhr();
		xhr.open("POST","../controller/DisplayQCM.php",true);
		xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); 
		xhr.send("idQCM="+idQCM);
		xhr.onreadystatechange=function (){
			if(xhr.readyState==4 && xhr.status==200){
				document.getElementById("display3").innerHTML=xhr.responseText;
			}
		}	
	}
	function editResults(){
		xhr=getxhr();
		xhr.open("GET","EditResultView.php",true); 
		xhr.send("null");
		xhr.onreadystatechange=function (){
			if(xhr.readyState==4 && xhr.status==200){
				document.getElementById("display0").innerHTML=xhr.responseText;
			}
		}
	}
	function getResults(){
		document.getElementById("display1").innerHTML="";
		xhr=getxhr();
		xhr.open("POST","../controller/ResultsAction.php",true);
		xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); 
		xhr.send("qcmYear="+document.getElementById("qcmYear").value);
		xhr.onreadystatechange=function (){
			if(xhr.readyState==4 && xhr.status==200){
				document.getElementById("display").innerHTML=xhr.responseText;
			}
		}
	}

	function setAccept(idStudent,qcmYear){
		xhr=getxhr();	
		xhr.open("POST","../controller/SetAcceptAction.php",true);
		xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); 
		xhr.send("qcmYear="+qcmYear+"&idStudent="+idStudent);
		xhr.onreadystatechange=function (){
			if(xhr.readyState==4){
				document.getElementById("display1").innerHTML=xhr.responseText;
				document.getElementById("display4").innerHTML="";
				getResults();
			}
		}		
	}
	function setRefuse(idStudent,qcmYear){
		xhr=getxhr();
		xhr.open("POST","../controller/setRefuseAction.php",true);
		xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); 
		xhr.send("qcmYear="+qcmYear+"&idStudent="+idStudent);
		xhr.onreadystatechange=function (){
			if(xhr.readyState==4 && xhr.status==200){
				document.getElementById("display1").innerHTML=xhr.responseText;
				getResults();
			}
		}
	}
	function refuse(idStudent,qcmYear){
		xhr=getxhr();
		xhr.onreadystatechange=function (){
			if(xhr.readyState==4 ){
				document.getElementById("display1").innerHTML=xhr.responseText;
				document.getElementById("display4").innerHTML="";
				get();
			}else{
				 document.getElementById("display4").innerHTML="<img src='../images/loader.gif' />"; 
			}
		}
		xhr.open("POST","../controller/RefuseStudentAction.php",true);
		xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded"); 
		xhr.send("qcmYear="+qcmYear+"&idStudent="+idStudent);
	}
</script>
<meta charset="utf-8" />
<title>Home</title>
</head>
<body>
	<div id="line1">
		<div id="menu">

			<div class="divi" id="divi1">
            <?php echo  $professor->getFirstName () . ' ' . $professor->getLastName (); ?>
        	</div>

			<div class="divi" id="divi1">
				<input class="inputProf" id="input1" type="button"
					onClick="createQCM()" value="Create QCM" />
			</div>

			<div class="divi" id="divi2">
				<input class="inputProf" id="input2" type="button"
					onClick="showMyQCMS(<?php echo $professor->getId();?>)"
					value="Show My QCMs" />
			</div>

			<div class="divi" id="divi3">
				<input id="input3" class="inputProf" type="button"
					onClick="validateStudents()" value="Validate Eligible Students" />
			</div>
			<div class="divi" id="divi5">
				<input class="inputProf" id="input5" type="button"
					onClick="editResults()" value="Edit Results" />
			</div>
			<!--   <div id="logoutg">-->
			<div class="divi" id="divi4">
				<input id="input4" class="inputProf" type="button"
					value="Disconnect" onClick="disconnect()" />
			</div>

		</div>

	</div>


	<div id="display0"></div>
	<div id="display4"></div>
	<script src="../js/jquery.js"></script>
	<script src="../js/professorHome.js"></script>
</body>
</html>