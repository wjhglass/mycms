function adminTopNav(j) {
	for (i = 1; i < 5; i++) {
		if (i == j) {
			document.getElementById("Nav" + i).style.backgroundPosition = "right bottom";
			document.getElementById("Nav" + i).style.color = "#3b6ea5";
		} else {
			document.getElementById("Nav" + i).style.backgroundPosition = "left bottom";
			document.getElementById("Nav" + i).style.color = "#fff";
		}
	}
}