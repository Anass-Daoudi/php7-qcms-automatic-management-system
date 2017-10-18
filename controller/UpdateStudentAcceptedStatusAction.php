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
$serverResponse = $uu->addQCMStudent ( $_POST ['idStudent'], $student->getQCMYear () );
?>
<div id="msg">
<?php

if ($serverResponse != false) {
	$u->updateStudentAccepted ( $_POST ['idStudent'], 1 );
	
	$message = "<h1><font color='#42e2a8'>Congratulations! " . $student->getFirstName () . " " . $student->getLastName () . " You have been selected to attend the Contest ENSA Marrakech {$_POST ['qcmYear']}</font></h1>";
	
	$to = $student->getEmail ();
	$subject = "Preselection Result Contest " . $_POST ['qcmYear'];
	$headers = "Content-Type: text/html;charset=utf-8";
	
	$bool = mail ( $to, $subject, $message, $headers );
	
	// echo "Student " . $student->getFirstName () . ' ' . $student->getLastName () . " has been added successfully to enter the contest";
} // else {
  // echo "Student " . $student->getFirstName () . ' ' . $student->getLastName () . " is already existing!";
  // }
?>
</div>