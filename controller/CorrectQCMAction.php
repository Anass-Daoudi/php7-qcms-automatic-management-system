<?php
require_once '../model/QCMDAOImpl.php';
require_once '../model/Student.php';

session_start ();
$student = $_SESSION ['student'];

$u = new QCMDAOImpl ();
if (isset ( $_POST ['idQCM'] )) {
	$scoreUser = 0;
	$qcm = $u->getQCM ( $_POST ['idQCM'] );
	$questions = $qcm->getQuestions ();
	
	for($i = 0; $i < count ( $questions ); $i ++) {
		$idQuestion = $questions [$i]->getIdQuestion ();
		$answers = $questions [$i]->getAnswers ();
		
		if (isset ( $_POST ["$idQuestion"] )) {
			for($j = 0; $j < count ( $_POST ["$idQuestion"] ); $j ++) {
				$idAnswerUser = $_POST ["$idQuestion"] [$j];
				
				for($p = 0; $p < count ( $answers ); $p ++) {
					if ($answers [$p]->getIdAnswer () == $idAnswerUser) {
						if ($answers [$p]->getValidity () == 1) {
							$scoreUser += 2;
						} else {
							$scoreUser -= 1;
						}
						break;
					}
				}
			}
		}
	}
	$u->setQCMSStudentScore ( $student->getId (), $_POST ['idQCM'], $scoreUser, 1 );
	header ( "location:../view/studenthome.php" );
	exit ();
}
?>