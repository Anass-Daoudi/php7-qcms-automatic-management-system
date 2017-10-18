<style>
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
	margin-bottom: 50px;
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

#div2 {
	text-align: left;
	margin: 20px;
	margin-top: 50px;
}

fieldset {
	border-radius: 8px;
	border: 3px dashed #F90;
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
</style>
<div id="qcmDisplay">
<?php
require_once '../model/QCMDAOImpl.php';
$u = new QCMDAOImpl ();
$qcm = $u->getQCM ( $_POST ['idQCM'] );

echo "<h3>Professor Creator:" . $qcm->getProfessor ()->getFirstName () . ' ' . $qcm->getProfessor ()->getLastName () . "</h3>";
echo "<h3>" . $qcm->getTitle () . "</h3>";
echo "<div id='div2'>";
echo "<fieldset>";
echo "<legend><h3>QCM Year: " . $qcm->getQCMYear () . "</h3></legend>";

$questions = $qcm->getQuestions ();
for($i = 0; $i < count ( $questions ); $i ++) {
	echo "<div class='question'><span class='qst'>Question" . ($i + 1) . " :    </span><span class='qst1'>" . $questions [$i]->getQuestionContent () . "</span>";
	$answers = $questions [$i]->getAnswers ();
	for($j = 0; $j < count ( $answers ); $j ++) {
		echo "<span class='rep'><input type=\"checkbox\" />" . $answers [$j]->getAnswerContent () . "</span>";
	}
	echo "</div>";
}
echo "</div>";
echo "</fieldset>";
?>
</div>