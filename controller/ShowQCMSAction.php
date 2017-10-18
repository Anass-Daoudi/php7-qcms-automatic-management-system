<style>
    /*#divShow{
        margin-left: 500px;
        margin-top: 100px;
    }*/

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
	background-color: #1ab744;
	color: aliceblue;
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

.validate {
	border: none;
}
</style>


<?php
require_once '../model/QCMDAOImpl.php';

$u = new QCMDAOImpl ();
$qcms = $u->getQCMSByIdProfessor ( $_POST ['idProfessor'] );

echo "<div id=\"divShow\"><table>";
echo "<tr >";
echo "<th >";
echo "QCM Title";
echo "</th>";
echo "<th>";
echo "QCM Year";
echo "</th>";
echo "<th>";
echo "QCM Display";
echo "</th>";
echo "</tr >";
for($i = 0; $i < count ( $qcms ); $i ++) {
	echo "<tr>";
	echo "<td>";
	echo ($qcms [$i])->getTitle ();
	echo "</td>";
	echo "<td>";
	echo $qcms [$i]->getQCMYear ();
	echo "</td>";
	echo "<td class='validate'>";
	echo "<input type=\"button\" class='tabValider' value='Display QCM' onClick=\"displayQCM(" . $qcms [$i]->getIdQCM () . ")\"/>";
	echo "</td>";
	echo "</tr>";
}
echo "</table></div>";
echo "<div align='center' id=\"display3\" />";
?>