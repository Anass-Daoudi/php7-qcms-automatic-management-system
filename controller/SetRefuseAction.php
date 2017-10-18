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
	border: 1px solid green;
	position: relative;
	top: 100px;
	text-align: center;
	/* border-radius: 6px;*/
	width: 600px;
	height: 35px;
	margin: auto;
	color: #c83652;
	background-color: #DFF2BF;
	font-weight: bold;
	width: 600px;
	height: 80px;
}

img {
	position: absolute;
	left: 5px;
}

.msg {
	margin-left: 30px;
}

#msg2, #msg3 {
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
	color: #D8000C;
	background-color: #FFBABA;
	font-weight: bold;
	width: 600px;
	height: 80px;
}
</style>
<?php
require_once '../model/QCMDAOImpl.php';
require_once '../model/StudentDAOImpl.php';

$u = new QCMDAOImpl ();
$uu = new StudentDAOImpl ();
$student = $uu->getStudent ( $_POST ['idStudent'] );

$message = "<h1><font color='#c83652'>Unfortunately! " . $student->getFirstName () . " " . $student->getLastName () . " you have not succeeded the Contest ENSA Marrakech {$_POST ['qcmYear']}</font></h1>";

$to = $student->getEmail ();
$subject = "Result Contest " . $_POST ['qcmYear'];
$headers = "Content-Type: text/html;charset=utf-8";

$bool = mail ( $to, $subject, $message, $headers );

/*
 * if ($bool) {
 * echo "Mail envoye avec succes.";
 * } else {
 * echo "Un probleme est survenu.";
 * }
 */

$u->setQCMStudentFinalResult ( $_POST ['qcmYear'], $_POST ['idStudent'], 0 );
$student = $uu->getStudent ( $_POST ['idStudent'] );
?><div id="msg"><?php
echo $student->getFirstName () . " " . $student->getLastName () . " is refused from entering ENSA Marrakech";
?>
</div>