<style>
@font-face {
	font-family: 'ballpark';
	src: url('../polices/ballpark.ttf');
}

@font-face {
	font-family: 'dayrom';
	src: url('../polices/dayrom.ttf');
}

#msg {
	font-family: dayrom;
	font-size: 26px;
	/*     border: 1px solid black;*/
	position: relative;
	top: 100px;
	text-align: center;
	/* border-radius: 6px;*/
	width: 600px;
	height: 35px;
	margin: auto;
	color: #1ab744;
	font-weight: bold;
}
</style>
<?php
require_once '../model/StudentDAOImpl.php';
require_once '../model/QCMDAOImpl.php';
require_once '../model/StudentDAOImpl.php';
require_once '../model/Student.php';

$u = new StudentDAOImpl ();
$uu = new QCMDAOImpl ();

$student = $u->getStudent ( $_POST ['idStudent'] );
$serverResponse = $uu->removeQCMStudent ( $_POST ['idStudent'], $student->getQCMYear () );

if ($serverResponse != false) {
	$u->updateStudentAccepted ( $_POST ['idStudent'], 0 );
	
	$message = "<h1><font color='red'>Sorry " . $student->getFirstName () . " " . $student->getLastName () . "! You can't attend the Contest ENSA Marrakech {$_POST ['qcmYear']}</font></h1>";
	
	$to = $student->getEmail ();
	$subject = "Preselection Result Contest " . $_POST ['qcmYear'];
	$headers = "Content-Type: text/html;charset=utf-8";
	
	$bool = mail ( $to, $subject, $message, $headers );
}
?>