<?php
class QCM {
	private $qcmYear;
	private $idQCM;
	private $professor;
	private $title;
	private $questions = array ();
	private $students = array ();
	public function __construct($professor, $title, $qcmYear) {
		$this->professor = $professor;
		$this->title = $title;
		$this->qcmYear = $qcmYear;
	}
	public function getQCMYear() {
		return $this->qcmYear;
	}
	public function setIdQCM($idQCM) {
		$this->idQCM = $idQCM;
	}
	public function getIdQCM() {
		return $this->idQCM;
	}
	public function getProfessor() {
		return $this->professor;
	}
	public function getTitle() {
		return $this->title;
	}
	public function getQuestions() {
		return $this->questions;
	}
	public function setQuestions($questions) {
		$this->questions = $questions;
	}
	public function addQuestion($question) {
		$this->questions [] = $question;
	}
	public function setStudents($students) {
		$this->students = $students;
	}
	public function addStudent($student) {
		$this->students [] = $student;
	}
	public function getStudents() {
		return $this->students;
	}
}
?>