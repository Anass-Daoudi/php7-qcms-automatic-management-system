<?php
require_once '../model/Checker.php';
class SignUpProfessorAction {
	
	public function doGet() {
		header ( "location:../view/signupprofessor.php" );
		exit ();
	}
	
	public function doPost() {
		require_once '../model/ProfessorDAOImpl.php';
		
		$error = "";
		$firstName = "";
		$lastName = "";
		$cin = "";
		$module = "";
		$email = "";
		$password = "";
		$passwordConfirmation = "";
		
		$trimmedFirstName = trim ( $_POST ['firstName'] );
		if (! empty ( $trimmedFirstName )) {
			$firstName = $trimmedFirstName;
			
			$trimmedLastName = trim ( $_POST ['lastName'] );
			if (! empty ( $trimmedLastName )) {
				$lastName = $trimmedLastName;
				
				$trimmedCin = trim ( $_POST ['cin'] );
				if (! empty ( $trimmedCin )) {
					$cin = $trimmedCin;
					
					$trimmedModule=trim($_POST['module']);
					if(!empty($trimmedModule)){
						$module=$trimmedModule;
						
						$trimmedEmail = $_POST ['email'];
						if (Checker::checkEmailFormat ( $trimmedEmail )) {
							$email = $trimmedEmail;
							
							if (strlen ( $_POST ['pass'] ) >= 6) {
								$password = $_POST ['pass'];
								
								if (strlen ( $_POST ['confirmpass'] ) == 0) {
									$error = "Password Confirmation must contain at least 6 characters";
								} else if ($password != $_POST ['confirmpass']) {
									$error = "Password and Password Confirmation must be equals";
								} else {
									$passwordConfirmation = $_POST ['confirmpass'];
									
									$pdi = new ProfessorDAOImpl();
									$pdi->insertProfessor( new Professor( $firstName, $lastName, $cin,$module, $email, $password ) );
									header ( "location:SignInAction.php" );
									exit ();
								}
							} else {
								$error = "Password must contain at least 6 characters";
							}
						} else {
							$error = "Email has to match the following pattern: ^[A-Za-z0-9-_.]+@[A-Za-z0-9-.]+\.[A-Za-z]{2,6}$";
						}
					}else{
						$error="Module must be filled in!";
					}
				} else {
					$error = "CIN must be filled in!";
				}
			} else {
				
				$error = "Last Name must be filled in!";
			}
		} else {
			$error = "First Name must be filled in!";
		}
		header ( "location:../view/signupprofessor.php?firstName=" . $firstName . '&lastName=' . $lastName . '&cin=' . $cin . '&module=' . $module . '&email=' . $email . '&password=' . $password . '&passwordConfirmation=' . $passwordConfirmation . '&error=' . $error );
		exit ();
	}
}

$signUpProfessorAction = new SignUpProfessorAction ();

if (isset ( $_POST ['submit'] )) {
	$signUpProfessorAction->doPost ();
	echo "hello";
} else {
	$signUpProfessorAction->doGet ();
}
?>