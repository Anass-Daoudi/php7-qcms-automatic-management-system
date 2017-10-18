<?php
require_once '../model/Professor.php';
session_start ();
$professor = $_SESSION ['professor'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="../css/style.css" />
<title>Questionnaire</title>
</head>
<body>
	<div id="page">
		<div align="center">
			<h2>Bienvenu <?php echo 'Mr. '.$professor->getFirstName().' '.$professor->getLastName();?></h2>
		</div>
		<form method="post" action="../controller/StoreQCMAction.php">
			<fieldset>
				<legend>QCM :</legend>
				<input type="text" name="title" id="title"
					placeholder="Saisir le titre du QCM" /><!--<br />-->
				<input type="number" name="qcmYear" id="qcmYear"
					placeholder="QCM Year" /><br /> <input type="button"
					id="addQuestion" value="Add Question" onClick="b()" />
				<div id="conteneur"></div>
				<input type="hidden" id="hidden" name="hidden" /> <input
					type="submit" value="Save QCM" id="valider" />
			</fieldset>
		</form>
	</div>
</body>
</html>