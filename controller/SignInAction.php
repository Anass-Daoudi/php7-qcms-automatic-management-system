<?php
class SignInAction {
	public function doGet() {
		header ( "location:../view/signin.php" );
		exit ();
	}
	public function doPost() {
		if (! empty ( $_POST ['email'] ) && ! empty ( $_POST ['pass'] )) {
			require_once '../model/StudentDAOImpl.php';
			require_once '../model/ProfessorDAOImpl.php';
			
			$sdi = new StudentDAOImpl ();
			$student = $sdi->exists ( $_POST ['email'], $_POST ['pass'] );
			
			if ($student != null) {
				session_start ();
				if ($student->getQCMYear () != date ( "Y" )) {
					$sdi->updateStudentQCMYear ( $student->getId (), date ( "Y" ) );
					$sdi->updateStudentAccepted ( $student->getId (), 0 );
					$student->setQCMYearArg ( date ( "Y" ) );
				}
				$_SESSION ['student'] = $student;
				header ( "location:../view/studenthome.php" );
				exit ();
			}
			
			$pdi = new ProfessorDAOImpl ();
			$professor = $pdi->exists ( $_POST ['email'], $_POST ['pass'] );
			
			if ($professor != null) {
				session_start ();
				$_SESSION ['professor'] = $professor;
				header ( "location:../view/professorhome.php" );
				exit ();
			}
		}
		$error = "Email or Password is incorrect!";
		header ( "location:../view/signin.php?error=" . $error );
		exit ();
	}
}

$signInAction = new SignInAction ();

if (isset ( $_POST ['submit'] )) {
	$signInAction->doPost ();
} else {
	$signInAction->doGet ();
}
?>