<?php
require_once 'ConnectionDB.php';
require_once 'Professor.php';
require_once 'ProfessorDAO.php';
class ProfessorDAOImpl implements ProfessorDAO {
	public function insertProfessor($professor) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "insert into professors (firstName,lastName,cin,module,email,password) values(?,?,?,?,?,?)";
		$statement = $pdo->prepare ( $sql );
		$statement->execute ( array (
				$professor->getFirstName (),
				$professor->getLastName (),
				$professor->getCin (),
				$professor->getModule (),
				$professor->getEmail (),
				md5 ( $professor->getPassword () ) 
		) );
	}
	public function exists($email, $password) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from professors where email=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$email 
		) );
		$row = $statement->fetch ();
		
		if ($row ['password'] === md5 ( $password )) {
			// pass null to password when getting professor object from database
			return new Professor ( $row ['firstName'], $row ['lastName'], $row ['cin'], $row ['module'], $row ['email'], null, $row ['id'] );
		}
		return null;
	}
	public function getProfessor($idProfessor) {
		$pdo = ConnectionDB::getInstance ();
		$sql = "select * from  professors where id=?";
		$statement = $pdo->prepare ( $sql );
		$statement->setFetchMode ( PDO::FETCH_BOTH );
		$statement->execute ( array (
				$idProfessor 
		) );
		$row = $statement->fetchAll ();
		return new Professor ( $row [0] ['firstName'], $row [0] ['lastName'], $row [0] ['cin'], $row [0] ['module'], $row [0] ['email'], null, $idProfessor );
	}
}
?>