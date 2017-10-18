<?php
require_once 'StudentDAO.php';
require_once 'Student.php';
require_once 'ConnectionDB.php';
class StudentDAOImpl implements StudentDAO {
	public function insertStudent($student) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "insert into students (firstName,lastName,birthday,qcmYear,cin,cne,field,mark,email,password) values (?,?,?,?,?,?,?,?,?,?)";
		$statement = $pdo->prepare ( $sql );
		
		echo $statement->execute ( array (
				$student->getFirstName (),
				$student->getLastName (),
				$student->getBirthday (),
				$student->getQCMYear (),
				$student->getCin (),
				$student->getCne (),
				$student->getField (),
				$student->getMark (),
				$student->getEmail (),
				md5 ( $student->getPassword () ) 
		) );
	}
	public function exists($email, $password) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from students where email=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$email 
		) );
		$row = $statement->fetch ();
		if (md5 ( $password ) === $row ['password']) {
			$student = new Student ( $row ['firstName'], $row ['lastName'], $row ['birthday'], $row ['cin'], $row ['cne'], $row ['field'], $row ['mark'], $row ['email'], null, $row ['id'] );
			$student->setQCMYearArg ( $row ['qcmYear'] );
			$student->setAccepted ( $row ['accepted'] );
			return $student;
		}
		return null;
	}
	public function getStudentsByQCMYear($qcmYear) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from students where qcmyear=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$qcmYear 
		) );
		$row = $statement->fetchAll ();
		$students = array ();
		for($i = 0; $i < count ( $row ); $i ++) {
			$student = new Student ( $row [$i] ['firstName'], $row [$i] ['lastName'], $row [$i] ['birthday'], $row [$i] ['cin'], $row [$i] ['cne'], $row [$i] ['field'], $row [$i] ['mark'], $row [$i] ['email'], null, $row [$i] ['id'] );
			$student->setQCMYearArg ( $row [$i] ['qcmYear'] );
			$student->setAccepted ( $row [$i] ['accepted'] );
			$students [] = $student;
		}
		return $students;
	}
	public function getAcceptedStudentsByQCMYear($qcmYear) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from students where qcmyear=? and accepted=1 ";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$qcmYear 
		) );
		$row = $statement->fetchAll ();
		$students = array ();
		for($i = 0; $i < count ( $row ); $i ++) {
			$student = new Student ( $row [$i] ['firstName'], $row [$i] ['lastName'], $row [$i] ['birthday'], $row [$i] ['cin'], $row [$i] ['cne'], $row [$i] ['field'], $row [$i] ['mark'], $row [$i] ['email'], null, $row [$i] ['id'] );
			$student->setQCMYearArg ( $row [$i] ['qcmYear'] );
			$student->setAccepted ( $row [$i] ['accepted'] );
			$students [] = $student;
		}
		return $students;
	}
	public function updateStudentAccepted($idStudent, $acceptedStatus) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "update students set accepted=? where id=?";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$acceptedStatus,
				$idStudent 
		) );
	}
	public function updateStudentQCMYear($idStudent, $qcmYear) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "update students set qcmYear=? where id=?";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$qcmYear,
				$idStudent 
		) );
	}
	public function getStudent($idStudent) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from students where id=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$idStudent 
		) );
		$row = $statement->fetch ();
		$student = new Student ( $row ['firstName'], $row ['lastName'], $row ['birthday'], $row ['cin'], $row ['cne'], $row ['field'], $row ['mark'], $row ['email'], null, $row ['id'] );
		$student->setQCMYearArg ( $row ['qcmYear'] );
		$student->setAccepted ( $row ['accepted'] );
		return $student;
	}
}
