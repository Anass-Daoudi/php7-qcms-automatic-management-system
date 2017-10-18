<?php
require_once 'Question.php';
require_once 'QuestionDAO.php';
require_once 'AnswerDAOImpl.php';
class QuestionDAOImpl implements QuestionDAO {
	public function addQuestion($question) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "insert into questions (idQCM,questionContent,currentQuestion) values(?,?,1)";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$question->getQCM ()->getIdQCM (),
				$question->getQuestionContent () 
		) );
		$u = new AnswerDAOImpl ();
		$idQuestion = $this->getCurrentQuestionId ();
		$question->setIdQuestion ( $idQuestion );
		foreach ( $question->getAnswers () as $answer ) {
			$answer->setQuestion ( $question );
			$u->addAnswer ( $answer );
		}
		$this->desactivateCurrentQuestionId ( $idQuestion );
	}
	private function getCurrentQuestionId() {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select idQuestion from questions where currentQuestion=1";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ();
		$row = $statement->fetch ();
		return $row ['idQuestion'];
	}
	private function desactivateCurrentQuestionId($idQuestion) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "update questions set currentQuestion=0 where idQuestion=?";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$idQuestion 
		) );
	}
	public function getQuestions($idQCM) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from questions where idQCM=? order by idQuestion";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$idQCM 
		) );
		$row = $statement->fetchAll ();
		$questions = array ();
		for($i = 0; $i < count ( $row ); $i ++) {
			$question = new Question ( $row [$i] ['questionContent'] );
			$question->setIdQuestion ( $row [$i] ['idQuestion'] );
			$question->setAnswers ( (new AnswerDAOImpl ())->getAnswers ( $question->getIdQuestion () ) );
			// think about that null for question attribute for answer object
			// $question->setQCM ( , $row [$i] ['title'], $row [$i] ['qcmYear'] ) );
			$questions [] = $question;
		}
		return $questions;
	}
}
?>