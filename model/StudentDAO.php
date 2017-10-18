<?php
interface StudentDAO {
	public function insertStudent($student);
	public function exists($email, $password);
	public function getStudentsByQCMYear($qcmYear);
	public function getStudent($idStudent);
	public function updateStudentAccepted($idStudent, $acceptedStatus);
	public function updateStudentQCMYear($idStudent, $qcmYear);
}
?>