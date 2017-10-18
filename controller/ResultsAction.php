<style>
@font-face {
	font-family: 'ballpark';
	src: url('../polices/ballpark.ttf');
}

@font-face {
	font-family: 'dayrom';
	src: url('../polices/dayrom.ttf');
}

th, td {
	border: 1px solid black;
	text-align: center;
	font-family: dayrom;
	font-size: 20px;
	border-collapse: collapse;
	border-radius: 8px;
	width: 300px;
	height: 50px;
}

th {
	background-color: #42e2a8;
	margin-bottom: 20px;
}

table {
	margin: auto;
	position: relative;
	top: 80px;
	border: none;
}

/*td {
	width: 200px;
	height: 25px;
}*/
.tabValider {
	font-family: dayrom;
	font-size: 20px;
	font-weight: bold;
	width: 100%;
	height: 100%;
	border-radius: 8px;
	background-color: orangered;
	outline: none;
	color: aliceblue;
}

#o {
	background-color: green;
}

.validate {
	border: none;
}
</style>
<?php
require_once '../model/QCMDAOImpl.php';
require_once '../model/StudentDAOImpl.php';

$u = new QCMDAOImpl ();
$row = $u->getStudentsScores ( $_POST ['qcmYear'] );
if ($row != null) {
	$uu = new StudentDAOImpl ();
	?>
<div>
	<table>
		<tr>
			<th>Status</th>
			<th>CNE</th>
			<th>FIRST NAME</th>
			<th>LAST NAME</th>
			<th>Score</th>
			<th colspan="2">Action</th>
		</tr>	
<?php
	for($i = 0; $i < count ( $row ); $i ++) {
		$idStudent = $row [$i] ['idStudent'];
		$idQCM = $row [$i] ['idQCM'];
		$score = $row [$i] ['score'];
		$qcm = $u->getQCM ( $idQCM );
		if ($qcm != false) {
			$student = $uu->getStudent ( $idStudent );
			$result = $u->getQCMStudentFinalResult ( $qcm->getQCMYear (), $idStudent );
			if ($result != false) {
				echo "<tr>";
				if ($result ['finalResult'] == 1) {
					echo "<td><img src='../images/Knob Valid Green.png' /></td>";
				} else {
					echo "<td><img src='../images/Knob Cancel.png' /></td>";
				}
				echo "<td>" . $student->getCne () . '</td><td> ' . $student->getFirstName () . "</td><td> " . $student->getLastName () . "</td><td>" . $score . "</td><td class=\"validate\" ><input id='o' class=\"tabValider\" type=\"button\" onClick='setAccept(" . $student->getId () . ',' . $_POST ['qcmYear'] . ")' value=\"Send Accept Mail\"/></td><td class=\"validate\" ><input class=\"tabValider\" type=\"button\" onClick='setRefuse(" . $student->getId () . ',' . $_POST ['qcmYear'] . ")' value=\"Send Refuse Mail\"/></td></tr>";
			}
		}
	}
	?>
  </table>
</div><?php
}
?>
