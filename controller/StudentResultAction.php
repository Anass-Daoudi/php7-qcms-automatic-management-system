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
	color: #4F8A10;
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

#warning {
	position: absolute;
	left: 5px;
	top: 5px;
}

#war {
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
	color: black;
	background-color: orange;
	font-weight: bold;
	width: 600px;
	height: 80px;
}
</style>
<?php
if (! empty ( $_POST ['qcmYear'] )) {
	require_once '../model/QCMDAOImpl.php';
	
	session_start ();
	$student = $_SESSION ['student'];
	$u = new QCMDAOImpl ();
	
	$result = $u->getQCMStudentFinalResult ( $_POST ['qcmYear'], $student->getId () );
	
	if ($result != false) {
		$result = $result ["finalResult"];
		$qcm = $u->getQCMByYear ( $_POST ['qcmYear'] );
		if ($qcm != false) {
			$contestAttended = $u->getQCMStudentContestPassedStatus ( $student->getId (), $qcm->getIdQCM () );
			if ($contestAttended == 1) {
				if ($result < 0) {
					?><div id="war"><?php
					echo "<img id='warning' src='../images/warning2.png' width='25px'/><span class='msg'>" . $student->getFirstName () . " " . $student->getLastName () . ", your results are not available yet for the Contest ENSA Marrakech {$_POST ['qcmYear']}</span>";
				} elseif ($result == 1) {
					?><div id="msg"><?php
					echo "<img src='../images/Knob Valid Green.png' /><span class='msg'>Congratulations! " . $student->getFirstName () . " " . $student->getLastName () . " You have succeeded the Contest ENSA Marrakech {$_POST ['qcmYear']}</span>";
				} else {
					?><div id="msg2"><?php
					echo "<img src='../images/Knob Cancel.png' /><span class='msg'>Unfortunately " . $student->getFirstName () . " " . $student->getLastName () . " you have not succeeded the Contest ENSA Marrakech {$_POST ['qcmYear']}</span>";
				}
			} else {
				?><div id="msg3"><?php
				echo "<img src='../images/Knob Cancel.png' /><span class='msg'>Sorry! " . $student->getFirstName () . " " . $student->getLastName () . " You have not attended the Contest ENSA Marrakech {$_POST ['qcmYear']}</span>";
			}
		}
	} else {
		?><div id="msg3"><?php
		echo "<img src='../images/Knob Cancel.png' /><span class='msg'>Sorry! " . $student->getFirstName () . " " . $student->getLastName () . " You have no result for the Contest ENSA Marrakech {$_POST ['qcmYear']}</span>";
	}
	?></div><?php
}
?>