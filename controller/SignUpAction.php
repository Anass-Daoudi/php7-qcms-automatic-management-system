<?php
require_once '../model/Checker.php';
class SignUpAction {
	public function doGet() {
		header ( "location:../view/signup.php" );
		exit ();
	}
	public function doPost() {
		require_once '../model/StudentDAOImpl.php';
		
		$error = "";
		$firstName = "";
		$lastName = "";
		$birthday = "";
		$cin = "";
		$cne = "";
		$filed = "";
		$mark = "";
		$email = "";
		$password = "";
		$passwordConfirmation = "";
		$pc = "";
		$svt = "";
		$sma = "";
		$smb = "";
		
		if (isset ( $_POST ['submit'] )) {
			
			$trimmedFirstName = trim ( $_POST ['firstName'] );
			if (! empty ( $trimmedFirstName )) {
				$firstName = $trimmedFirstName;
				
				$trimmedLastName = trim ( $_POST ['lastName'] );
				if (! empty ( $trimmedLastName )) {
					$lastName = $trimmedLastName;
					
					$trimmedBirthday = trim ( $_POST ['birthday'] );
					if (! empty ( $trimmedBirthday ) && Checker::checkDateFormat ( $trimmedBirthday )) {
						$birthday = $trimmedBirthday;
						
						$trimmedCin = trim ( $_POST ['cin'] );
						if (! empty ( $trimmedCin )) {
							$cin = $trimmedCin;
							
							$trimmedCne = trim ( $_POST ['cne'] );
							if (! empty ( $trimmedCne )) {
								$cne = $trimmedCne;
								$selected = true;
								
								if ($_POST ['selection'] == 'PC') {
									$pc = "selected";
								} else if ($_POST ['selection'] == 'SVT') {
									$svt = "selected";
								} else if ($_POST ['selection'] == 'SM-A') {
									$sma = "selected";
								} else if ($_POST ['selection'] == 'SM-B') {
									$smb = "selected";
								} else {
									$selected = false;
									$error = "Field must be chosen!";
								}
								if ($selected) {
									$field = $_POST ['selection'];
									
									$trimmedMark = trim ( $_POST ['mark'] );
									if (is_numeric ( $trimmedMark )) {
										$mark = $trimmedMark;
										
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
													
													$sdi = new StudentDAOImpl ();
													$student = new Student ( $firstName, $lastName, $birthday, $cin, $cne, $field, $mark, $email, $password );
													$student->setQCMYearArg ( date ( "Y" ) );
													$sdi->insertStudent ( $student );
													header ( "location:SignInAction.php" );
													exit ();
												}
											} else {
												$error = "Password must contain at least 6 characters";
											}
										} else {
											$error = "Email has to match the following pattern: ^[A-Za-z0-9-_.]+@[A-Za-z0-9-.]+\.[A-Za-z]{2,6}$";
										}
									} else {
										$error = "Mark must be filled in!";
									}
								}
							} else {
								$error = "CNE must be filled in!";
							}
						} else {
							$error = "CIN must be filled in!";
						}
					} else {
						$error = "Birthday must be in the format: day-month-year";
					}
				} else {
					
					$error = "Last Name must be filled in!";
				}
			} else {
				
				$error = "First Name must be filled in!";
			}
		}
		header ( "location:../view/signup.php?firstName=" . $firstName . '&lastName=' . $lastName . '&birthday=' . $birthday . '&cin=' . $cin . '&cne=' . $cne . '&pc=' . $pc . '&svt=' . $svt . '&sma=' . $sma . '&smb=' . $smb . '&mark=' . $mark . '&email=' . $email . '&password=' . $password . '&passwordConfirmation=' . $passwordConfirmation . '&error=' . $error );
		exit ();
	}
}

$signUpAction = new SignUpAction ();

if (isset ( $_POST ['submit'] )) {
	$signUpAction->doPost ();
} else {
	$signUpAction->doGet ();
}

?>