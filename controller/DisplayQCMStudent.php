<style>
.badLuck {
	font-family: dayrom;
	font-size: 26px;
	border: 1px solid red;
	position: relative;
	top: 100px;
	text-align: center;
	/* border-radius: 6px;*/
	width: 600px;
	height: 35px;
	margin: auto;
	font-weight: bold;
	color: #D8000C;
	background-color: #FFBABA;
	height: 50px;
	padding-top: 12px;
}

.msg {
	margin-left: 30px;
}

img {
	position: absolute;
	left: 3px;
}

@font-face {
	font-family: 'ballpark';
	src: url('../polices/ballpark.ttf');
}

@font-face {
	font-family: 'dayrom';
	src: url('../polices/dayrom.ttf');
}

legend, h3 {
	font-family: dayrom;
	font-size: 28px;
}

.question {
	font-family: verdana;
	font-size: 20px;
	margin: 20px;
}

#qcmDisplay {
	position: relative;
	top: 100px;
	width: 60%;
}

#div2 {
	text-align: left;
	margin: 20px;
	margin-top: 50px;
}

fieldset {
	border-radius: 8px;
	border: 3px dashed #F90;
}

legend {
	/*font-family: verdana, arial, sans-serif;
	font-size: 14pt;
	font-weight: bold;
	margin: 10px;*/
	/*padding:1px;*/
	background-color: #AAAAAA;
	border-radius: 4px;
	color: #FFFFFF;
}

.qst {
	margin-right: 5px;
}

.qst1 {
	margin-right: 40px;
}

.rep {
	margin-right: 20px;
}

#submit {
	margin-left: 200px;
	margin-top: 20px;
	background-color: #EE6600;
	color: #FFFFFF;
	padding: 6px 20px 6px 20px;
	border: none;
	cursor: pointer;
	padding: 10px;
	width: 240px;
	outline: none;
	/* border:solid 1px #AAAAAA;*/
	padding: 10px;
	border-radius: 4px;
	font-family: verdana, arial, sans-serif;
	font-size: 20px;
}

#noPassed {
	height: 80px;
}

#spanNoPassed {
	margin-left: 30px;
}

#imgNoPassed {
	margin-left: 30px;
}
</style>
<div id="qcmDisplay">
<?php
require_once '../model/StudentDAOImpl.php';
$uu = new StudentDAOImpl ();
$student = $uu->getStudent ( $_POST ['idStudent'] );
if ($student->getAccepted () == 1) {
	require_once '../model/QCMDAOImpl.php';
	
	$u = new QCMDAOImpl ();
	$idQCM = $u->getIdQCMStudent ( $_POST ['idStudent'], $_POST ['qcmYear'] );
	$qcm = $u->getQCMByYear ( $_POST ['qcmYear'] );
	
	if ($qcm != false) {
		if ($u->getQCMStudentContestPassedStatus ( $_POST ['idStudent'], $idQCM ) == 0) {
			echo "<form method='POST' action='../controller/CorrectQCMAction.php'>";
			echo "<input type='hidden' name='idQCM' value='" . $idQCM . "' />";
			$qcm = $u->getQCM ( $idQCM );
			echo "<h3>Professor Creator: <font color='red'>" . $qcm->getProfessor ()->getFirstName () . ' ' . $qcm->getProfessor ()->getLastName () . "</font></h3>";
			echo "<h3>" . $qcm->getTitle () . "</h3>";
			echo "<div id='div2'>";
			echo "<fieldset>";
			echo "<legend><h3>QCM Year: " . $qcm->getQCMYear () . "</h3></legend>";
			
			$questions = $qcm->getQuestions ();
			for($i = 0; $i < count ( $questions ); $i ++) {
				echo "<div class='question'><span class='qst'>Question" . ($i + 1) . ": </span><span class='qst1'>" . $questions [$i]->getQuestionContent () . "</span>";
				$answers = $questions [$i]->getAnswers ();
				for($j = 0; $j < count ( $answers ); $j ++) {
					echo "<span class='rep'><input name='" . $questions [$i]->getIdQuestion () . "[]' type='checkbox' value='" . $answers [$j]->getIdAnswer () . "'/>" . $answers [$j]->getAnswerContent () . "</span>";
				}
				echo "<br />";
			}
			echo "</div>";
			echo "<input id='submit' type=\"submit\" value=\"Submit My Solution\" />";
			echo "</form>";
		} else {
			echo "<div class='badLuck' id='noPassed'><img id='imgNoPassed' src='../images/Knob Cancel.png' /><span class='msg' id='spanNoPassed'>Sorry, you have already submitted your solution!!</span></div>";
			echo "</div>";
			echo "</fieldset>";
		}
	} else {
		echo "<div class='badLuck'><img src='../images/Knob Cancel.png' /><span class='msg'>Sorry, the contest {$_POST['qcmYear']} is not available yet!</span></div>";
	}
} else {
	echo "<div class='badLuck'><img src='../images/Knob Cancel.png' /><span class='msg'>Sorry , you're not eligible to pass this contest!</span></div>";
}
?>
</div>


