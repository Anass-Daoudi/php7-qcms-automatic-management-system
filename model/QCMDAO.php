<?php
interface QCMDAO {
	public function addQCM($qcm);
	public function addQCMStudent($idStudent, $qcmYear);
	public function updateQCMSStudent($qcm);
	public function getQCMId($qcmYear);
	public function getQCMSByIdProfessor($idProfessor);
	public function getQCM($idQCM);
	public function getStudents($idQCM);
	public function getIdQCMStudent($idStudent, $qcmYear);
	public function getQCMByYear($qcmYear);
	public function setQCMSStudentScore($idStudent, $idQCM, $score, $contestPassed);
	public function getQCMStudentContestPassedStatus($idStudent, $idQCM);
	public function getStudentsScores($qcmYear);
	public function setQCMStudentFinalResult($qcmYear, $idStudent, $finalResult);
	public function getQCMStudentFinalResult($qcmYear, $idStudent);
	public function removeQCMStudent($idStudent, $qcmYear);
}
?>