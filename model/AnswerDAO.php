<?php
interface AnswerDAO {
	public function addAnswer($answer);
	public function getAnswers($idQuestion);
}
?>