<?php
require_once 'ConnectionDB.php';
require_once 'Answer.php';
require_once 'AnswerDAO.php';
class AnswerDAOImpl implements AnswerDAO {
	public function addAnswer($answer) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "insert into answers (idQuestion,answerContent,validity) values(?,?,?)";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$answer->getQuestion ()->getIdQuestion (),
				$answer->getAnswerContent (),
				$answer->getValidity () 
		
		) );
	}
	public function getAnswers($idQuestion) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from answers where idQuestion=? order by idAnswer";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$idQuestion 
		) );
		$row = $statement->fetchAll ();
		$answers = array ();
		for($i = 0; $i < count ( $row ); $i ++) {
			// think about that null for question attribute for answer object
			$answer = new Answer ( null, $row [$i] ['answerContent'], $row [$i] ['validity'] );
			$answer->setIdAnswer ( $row [$i] ['idAnswer'] );
			$answers [] = $answer;
		}
		return $answers;
	}
}

?>