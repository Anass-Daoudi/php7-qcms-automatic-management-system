<?php
class Answer {
	private $idAnswer;
	private $question;
	private $answerContent;
	private $validity;
	public function __construct($question, $answerContent, $validity) {
		$this->question = $question;
		$this->answerContent = $answerContent;
		$this->validity = $validity;
	}
	public function setIdAnswer($idAnswer) {
		$this->idAnswer = $idAnswer;
	}
	public function getIdAnswer() {
		return $this->idAnswer;
	}
	public function setQuestion($question) {
		$this->question = $question;
	}
	public function getQuestion() {
		return $this->question;
	}
	public function getAnswerContent() {
		return $this->answerContent;
	}
	public function getValidity() {
		return $this->validity;
	}
}
?>