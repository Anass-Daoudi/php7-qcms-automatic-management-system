<?php
require_once 'ConnectionDB.php';
require_once 'QuestionDAOImpl.php';
require_once 'Question.php';
require_once 'QCMDAO.php';
require_once 'QCM.php';
require_once 'ProfessorDAOImpl.php';
require_once 'StudentDAOImpl.php';
class QCMDAOImpl implements QCMDAO {
	public function addQCM($qcm) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "insert into qcm (title,idProfessor,qcmYear) values(?,?,?)";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$qcm->getTitle (),
				$qcm->getProfessor ()->getId (),
				$qcm->getQCMYear () 
		) );
		$u = new QuestionDAOImpl ();
		$qcm->setIdQCM ( $this->getQCMId ( $qcm->getQCMYear () ) );
		foreach ( $qcm->getQuestions () as $question ) {
			$question->setQCM ( $qcm );
			$u->addQuestion ( $question );
		}
		$this->updateQCMSStudent ( $qcm );
		/*
		 * foreach ( $qcm->getStudents () as $student ) {
		 * $this->addQCMStudent ( $student->getId (), $qcm->getIdQCM (), date ( "Y" ) );
		 * }
		 */
	}
	public function updateQCMSStudent($qcm) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "update qcmscore set idQCM=? where qcmYear=?";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$qcm->getIdQCM (),
				$qcm->getQCMYear () 
		) );
	}
	public function addQCMStudent($idStudent, $qcmYear) {
		$pdo = ConnectionDB::getInstance ();
		$exists = $this->qcmsStudentExists ( $idStudent, $qcmYear );
		if ($exists == false) {
			$qcm = $this->getQCMByYear ( $qcmYear );
			if ($qcm != null) {
				$this->insertQCMStudentWithIdQCM ( $idStudent, $qcmYear, $qcm->getIdQCM () );
			} else {
				$this->insertQCMStudentWithoutIdQCM ( $idStudent, $qcmYear );
			}
			return true;
		} else {
			return false;
		}
	}
	private function insertQCMStudentWithIdQCM($idStudent, $qcmYear, $idQCM) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "insert into qcmscore (idQCM,idStudent,qcmYear) values(?,?,?)";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$idQCM,
				$idStudent,
				$qcmYear 
		) );
	}
	private function insertQCMStudentWithoutIdQCM($idStudent, $qcmYear) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "insert into qcmscore (idStudent,qcmYear) values(?,?)";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$idStudent,
				$qcmYear 
		) );
	}
	public function getQCMByYear($qcmYear) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from qcm where qcmYear=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$qcmYear 
		) );
		$row = $statement->fetch ();
		if ($row != false) {
			$professor = (new ProfessorDAOImpl ())->getProfessor ( $row ['idProfessor'] );
			$qcm = new QCM ( $professor, $row ['title'], $row ['qcmYear'] );
			$qcm->setIdQCM ( $row ['idQCM'] );
			$qcm->setQuestions ( (new QuestionDAOImpl ())->getQuestions ( $qcm->getIdQCM () ) );
			$qcm->setStudents ( $this->getStudents ( $qcm->getIdQCM () ) );
			return $qcm;
		}
		return false;
	}
	private function qcmsStudentExists($idStudent, $qcmYear) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from qcmscore where idStudent=? and qcmYear=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$idStudent,
				$qcmYear 
		) );
		$row = $statement->fetch ();
		if ($row != false) {
			return true;
		}
		return false;
	}
	public function getQCMId($qcmYear) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select idQCM from qcm where qcmYear=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$qcmYear 
		) );
		$row = $statement->fetch ();
		return $row ['idQCM'];
	}
	public function getQCMSByIdProfessor($idProfessor) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from qcm where idProfessor=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$idProfessor 
		) );
		$row = $statement->fetchAll ();
		$qcms = array ();
		$professor = (new ProfessorDAOImpl ())->getProfessor ( $idProfessor );
		for($i = 0; $i < count ( $row ); $i ++) {
			$qcm = new QCM ( $professor, $row [$i] ['title'], $row [$i] ['qcmYear'] );
			$qcm->setIdQCM ( $row [$i] ['idQCM'] );
			$qcm->setQuestions ( (new QuestionDAOImpl ())->getQuestions ( $qcm->getIdQCM () ) );
			$qcm->setStudents ( $this->getStudents ( $qcm->getIdQCM () ) );
			$qcms [] = $qcm;
		}
		return $qcms;
	}
	public function getQCM($idQCM) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from qcm where idQCM=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$idQCM 
		) );
		$row = $statement->fetch ();
		if ($row != false) {
			$professor = (new ProfessorDAOImpl ())->getProfessor ( $row ['idProfessor'] );
			$qcm = new QCM ( $professor, $row ['title'], $row ['qcmYear'] );
			$qcm->setIdQCM ( $row ['idQCM'] );
			$qcm->setQuestions ( (new QuestionDAOImpl ())->getQuestions ( $qcm->getIdQCM () ) );
			$qcm->setStudents ( $this->getStudents ( $qcm->getIdQCM () ) );
			return $qcm;
		}
		return false;
	}
	public function getStudents($idQCM) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select idStudent from qcmscore where idQCM=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$idQCM 
		) );
		$row = $statement->fetchAll ();
		$students = array ();
		
		for($i = 0; $i < count ( $row ); $i ++) {
			$students [] = (new StudentDAOImpl ())->getStudent ( $row [$i] ['idStudent'] );
		}
		return $students;
	}
	public function getIdQCMStudent($idStudent, $qcmYear) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select idQCM from qcmscore where idStudent=? and qcmYear=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$idStudent,
				$qcmYear 
		) );
		$row = $statement->fetch ();
		if ($row != false) {
			return $row ['idQCM'];
		}
		return false;
	}
	public function setQCMSStudentScore($idStudent, $idQCM, $score, $contestPassed) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "update qcmscore set score=?,contestPassed=?  where idQCM=? and idStudent=?";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$score,
				$contestPassed,
				$idQCM,
				$idStudent 
		) );
	}
	public function getQCMStudentContestPassedStatus($idStudent, $idQCM) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select contestPassed from qcmscore where idStudent=? and idQCM=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$idStudent,
				$idQCM 
		) );
		$row = $statement->fetch ();
		return $row ['contestPassed'];
	}
	public function getStudentsScores($qcmYear) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from qcmscore where qcmYear=? order by score desc";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$qcmYear 
		) );
		$row = $statement->fetchAll ();
		return $row;
	}
	public function setQCMStudentFinalResult($qcmYear, $idStudent, $finalResult) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "update qcmscore set finalResult=? where qcmYear=? and idStudent=?";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$finalResult,
				$qcmYear,
				$idStudent 
		) );
	}
	public function getQCMStudentFinalResult($qcmYear, $idStudent) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select finalResult from qcmscore where qcmYear=? and idStudent=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$qcmYear,
				$idStudent 
		) );
		$row = $statement->fetch ();
		if ($row != false) {
			return $row;
		}
		return false;
	}
	public function removeQCMStudent($idStudent, $qcmYear) {
		$pdo = ConnectionDB::getInstance ();
		$exists = $this->qcmsStudentExists ( $idStudent, $qcmYear );
		if ($exists == true) {
			$sql = "delete from qcmScore where idStudent=? and qcmYear=?";
			$statement = $pdo->prepare ( $sql );
			$statement->execute ( array (
					$idStudent,
					$qcmYear 
			) );
			return true;
		} else {
			return false;
		}
	}
}
?>