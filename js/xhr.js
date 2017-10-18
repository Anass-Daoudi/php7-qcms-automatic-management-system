function getxhr() {
	try {
		xhr = new XMLHttpRequest();
	} catch (e) {
		try {
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e1) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTTP");
			} catch (e2) {
				alert("AJAX n'est pas supporté par votre navigateur!");
			}
		}
	}
	return xhr;
}