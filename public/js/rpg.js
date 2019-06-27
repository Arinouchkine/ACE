var map = new Map("premiere");
/*map.addPersonnage(new Personnage("exemple.png", 7, 14, DIRECTION.HAUT));
map.addPersonnage(new Personnage("exemple.png", 7, 0, DIRECTION.BAS));
map.addPersonnage(new Personnage("exemple.png", 0, 7, DIRECTION.DROITE));
map.addPersonnage(new Personnage("exemple.png", 14, 7, DIRECTION.GAUCHE));*/
/*On cree un personnage qui s'apelle joueur et on l'ajoute au tableau personnage grace à addPersonnage*/
var joueur = new Personnage("exemple.png", 7, 10, DIRECTION.HAUT);
map.addPersonnage(joueur);


var monstre = new Monstre("monstre.png", 14, 7,  DIRECTION.BAS);
map.addMonstre(monstre);



window.onload = function() {
	/*Pour dessiner dans un canvas on utlise le contexte, avec ctx et on dit qu'on dessine en 2D*/ 
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	/*ICI on definit la taille du canvas*/	
	canvas.width  = map.getLargeur() * 32;
	canvas.height = map.getHauteur() * 32;

	
	setInterval(function() {
		map.dessinerMap(ctx);
		
	}, 40);

	// Gestion du clavier
	window.onkeydown = function(event) {
		var e = event || window.event;
		var key = e.which || e.keyCode;
		switch(key) {
			case 38 : case 122 : case 119 : case 90 : case 87 : // Flèche haut, z, w, Z, W
				joueur.deplacer(DIRECTION.HAUT, map);

			break;

			case 40 : case 115 : case 83 : // Flèche bas, s, S
				joueur.deplacer(DIRECTION.BAS, map);

			break;

			case 37 : case 113 : case 97 : case 81 : case 65 : // Flèche gauche, q, a, Q, A
				joueur.deplacer(DIRECTION.GAUCHE, map);

			break;

			case 39 : case 100 : case 68 : // Flèche droite, d, D
				joueur.deplacer(DIRECTION.DROITE, map);

			break;

			default : 
			//alert(key);
			// Si la touche ne nous sert pas, nous n'avons aucune raison de bloquer son comportement normal.
			return true;
		}
	}
	
}
