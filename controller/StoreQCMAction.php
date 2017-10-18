<?php
require_once '../model/Answer.php';
require_once '../model/Question.php';
require_once '../model/Professor.php';
require_once '../model/QCM.php';
require_once '../model/QCMDAOImpl.php';
require_once '../model/StudentDAOImpl.php';

if (isset ( $_POST ['title'] )) {
	session_start ();
	$professor = $_SESSION ['professor'];
	$u = new StudentDAOImpl ();
	$uu = new QCMDAOImpl ();
	
	$qcm = new QCM ( $professor, $_POST ['title'], $_POST ['qcmYear'] );
	//$students = $u->getAcceptedStudentsByQCMYear ( $_POST ['qcmYear'] );
	//$qcm->setStudents ( $students );
	$questions = array ();
	for($i = 1; $i <= $_POST ['hidden']; $i ++) {
		$question = new Question ( $_POST ["question$i"] );
		$answers = array ();
		for($j = 0; $j < $_POST ["hidden$i"]; $j ++) {
			$answer = new Answer ( $question, $_POST ["reponse$i$j"], isset ( $_POST ["check$i$j"] ) ? 1 : 0 );
			$answers [] = $answer;
		}
		$question->setAnswers ( $answers );
		$questions [] = $question;
	}
	$qcm->setQuestions ( $questions );
	$uu->addQCM ( $qcm );
	header ( "location:../view/professorhome.php" );
	exit ();
}
?>