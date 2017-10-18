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
	color: black;
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
	background-color: green;
	outline: none;
	color: aliceblue;
}

.tabRefuse {
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

.validate {
	border: none;
}
</style>

<?php
require_once '../model/StudentDAOImpl.php';
require_once '../model/Student.php';
if (! empty ( $_POST ['qcmYear'] )) {
	$u = new StudentDAOImpl ();
	$students = $u->getStudentsByQCMYear ( $_POST ['qcmYear'] );
	?>
<div>
	<table>
		<tr>
			<th>Status</th>
			<th>CNE</th>
			<th>FIRST NAME</th>
			<th>LAST NAME</th>
			<th colspan="2">VALIDATE</th>
		</tr>
	<?php
	if (count ( $students ) != 0) {
		foreach ( $students as $student ) {
			echo "<tr>";
			if ($student->getAccepted () == 1) {
				echo "<td><img src='../images/Knob Valid Green.png' /></td>";
			} else {
				echo "<td><img src='../images/Knob Cancel.png' /></td>";
			}
			
			echo "<td>" . $student->getCne () . '</td><td> ' . $student->getFirstName () . "</td><td> " . $student->getLastName () . "</td><td class=\"validate\" >" . "<input class=\"tabValider\" type=\"button\" onClick='validate(" . $student->getId () . ")' value=\"Validate\"/></td><td><input class=\"tabRefuse\" type=\"button\" onClick='refuse(" . $student->getId () . "," . $_POST ['qcmYear'] . ")' value=\"Refuse\"/></td></tr>";
		}
	}
	?>
    </table>
</div>
<?php }?>