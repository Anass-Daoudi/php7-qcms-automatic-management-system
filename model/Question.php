<?php
class Question {
	private $idQuestion;
	private $qcm;
	private $questionContent;
	private $answers = array ();
	public function __construct($questionContent) {
		$this->questionContent = $questionContent;
	}
	public function setQCM($qcm) {
		$this->qcm = $qcm;
	}
	public function setIdQuestion($idQuestion) {
		$this->idQuestion = $idQuestion;
	}
	public function getIdQuestion() {
		return $this->idQuestion;
	}
	public function getQCM() {
		return $this->qcm;
	}
	public function getQuestionContent() {
		return $this->questionContent;
	}
	public function setAnswers($answers) {
		$this->answers = $answers;
	}
	public function addAnswer($answer) {
		$this->answers [] = $answer;
	}
	public function getAnswers() {
		return $this->answers;
	}
}
?>