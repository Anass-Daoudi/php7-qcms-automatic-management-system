function disconnect() {
	xhr = getxhr();
	xhr.open("GET", "../controller/DisconnectAction.php", true);
	xhr.send("null");
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			window.location = "../view/home.php";
		}
	}
}