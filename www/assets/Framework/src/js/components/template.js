$.ajax({
	url: window.location.origin + "/GetTemplates", // L'URL n'inclut plus le paramètre active=true
	method: 'GET',
	success: function(response) {
		const bodyColor = response.bodyColor;
		const navbarColor = response.navbarColor;
		const navbarmenusColor = response.navbarmenusColor;
		const textColor = response.textColor;
		const fontName = response.fontName;
		const fontSizePx = response.fontSizePx;
		document.documentElement.style.setProperty('--body-color', bodyColor);
		document.documentElement.style.setProperty('--navbar-color', navbarColor);
		document.documentElement.style.setProperty('--navbarmenu-color', navbarmenusColor);
		document.documentElement.style.setProperty('--text-color', textColor);
		document.documentElement.style.setProperty('--font-family', fontName);
		document.documentElement.style.setProperty('--font-size', fontSizePx + "px");

		function compareURI(uriToCheck) {
			var uri = window.location.pathname.toLowerCase();
			uri = uri.split("?")[0];
			uri = uri.length > 1 ? uri.replace(/\/$/, "") : uri;

			// Si l'URI commence par uriToCheck suivi d'un slash ou de rien, alors on considère que c'est une correspondance
			return uri.startsWith(uriToCheck + "/") || uri === uriToCheck;
		}

		if (compareURI("/")) {
			document.getElementById("navbarMain").style.color = navbarmenusColor; // ou toute autre couleur souhaitée
		}

		if (compareURI("/page")) {
			document.getElementById("navbarMain").style.color = navbarmenusColor; // ou toute autre couleur souhaitée
		}

		if (compareURI("/login")) {
			document.getElementById("navbarLogin").style.color = navbarmenusColor; // ou toute autre couleur souhaitée
		}

		if (compareURI("/contact")) {
			document.getElementById("navbarContact").style.color = navbarmenusColor; // ou toute autre couleur souhaitée
		}

		if (compareURI("/register")) {
			document.getElementById("navbarRegister").style.color = navbarmenusColor; // ou toute autre couleur souhaitée
		}

		if (compareURI("/menu")) {
			document.getElementById("navbarMenu").style.color = navbarmenusColor; // ou toute autre couleur souhaitée
		}

		if (compareURI("/page")) {
			document.getElementById("navbarPage").style.color = navbarmenusColor; // ou toute autre couleur souhaitée
		}

		if (compareURI("/account")) {
			document.getElementById("navbarAccount").style.color = navbarmenusColor; // ou toute autre couleur souhaitée
		}

	},
	error: function(xhr, status, error) {

	}
});

// Vérification de l'existence de chaque élément avant d'attacher des écouteurs d'événements

var bkColorInput = document.getElementById('preview-bkcolor');
if (bkColorInput) {
	bkColorInput.addEventListener('input', function() {
		var color = this.value;
		var backgroundPreview = document.getElementById('background-preview');
		if (backgroundPreview) {
			backgroundPreview.style.backgroundColor = color;
		}
	});
}

var navColorInput = document.getElementById('preview-navcolor');
if (navColorInput) {
	navColorInput.addEventListener('input', function() {
		var color = this.value;
		var headerPreview = document.getElementById('header-preview');
		if (headerPreview) {
			headerPreview.style.backgroundColor = color;
		}
	});
}

var txtColorInput = document.getElementById('preview-txtcolor');
if (txtColorInput) {
	txtColorInput.addEventListener('input', function() {
		var color = this.value;
		var backgroundPreview = document.getElementById('background-preview');
		if (backgroundPreview) {
			backgroundPreview.style.color = color;
		}
	});
}

var navMenuColorInput = document.getElementById('preview-navmenucolor');
if (navMenuColorInput) {
	navMenuColorInput.addEventListener('input', function() {
		var color = this.value;
		var menusPreview = document.getElementById('menus-preview');
		if (menusPreview) {
			menusPreview.style.color = color;
		}
	});
}

var sizeInput = document.getElementById('preview-size');
if (sizeInput) {
	sizeInput.addEventListener('input', function() {
		var size = this.value;
		var menusPreview = document.getElementById('menus-preview');
		var backgroundPreview = document.getElementById('background-preview');
		if (menusPreview && backgroundPreview) {
			menusPreview.style.fontSize = size + "px";
			backgroundPreview.style.fontSize = size + "px";
		}
	});
}

var fontInput = document.getElementById('preview-font');
if (fontInput) {
	fontInput.addEventListener('change', function() {
		var font = this.value;
		var menusPreview = document.getElementById('menus-preview');
		var backgroundPreview = document.getElementById('background-preview');
		if (menusPreview && backgroundPreview) {
			menusPreview.style.fontFamily = font;
			backgroundPreview.style.fontFamily = font;
		}
	});
}