/**
* Creates a new form for a new user to be added to the system
**/

window.onload = function() {
	document.getElementById("addRush").onclick = function() {
		// First create the div containers
		var formContainer = document.createElement("div");
		var leftCol = document.createElement("div");
		var rightCol = document.createElement("div");
		formContainer.className = "row narrow officer-control";	// line 118 in admin_func.php
		leftCol.className = "col-md-3 officer-upload"; // line 119 in admin_func.php
		rightCol.className = "col-md-9";
		formContainer.appendChild(leftCol);
		formContainer.appendChild(rightCol);
		
		var image = document.createElement("img")
		image.setAttribute("src", "layout/contact/7.png");
		image.setAttribute("alt", "sucker");
		image.setAttribute("class", "img-responsive img-rounded");
		
		var help = document.createElement("span");
		help.setAttribute("class", "help-block form-help");
		help.innerHTML = "Must upload a 300x200 .png file";
		
		var uploader = document.createElement("input");
		uploader.setAttribute("type", "file");
		
		var header = document.createElement("input");
		header.setAttribute("type", "text");
		header.setAttribute("name", "100_header");
		header.setAttribute("class", "form-control");
		header.setAttribute("value", "YOOO");
		
		var info = document.createElement("textarea");
		info.setAttribute("type", "text");
		info.setAttribute("name", "100_header");
		info.setAttribute("class", "form-control");
		info.innerHTML = "asdfsafsfsf";
		
		var bio = document.createElement("textarea");
		bio.setAttribute("type", "text");
		bio.setAttribute("name", "100_header");
		bio.setAttribute("class", "form-control");
		bio.innerHTML = "bio here";
		
		leftCol.appendChild(image);
		leftCol.appendChild(help);
		leftCol.appendChild(uploader);
		
		rightCol.appendChild(header);
		rightCol.appendChild(info);
		rightCol.appendChild(bio);
		
		document.getElementById("rush").appendChild(formContainer);
	};
}