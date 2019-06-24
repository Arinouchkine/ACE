var DIRECTION = {
	"BAS"    : 0,
	"GAUCHE" : 1,
	"DROITE" : 2,
	"HAUT"   : 3
}
var DUREE_ANIMATION = 4;
var DUREE_DEPLACEMENT = 15;
this.etatAnimation = -1;

/*
Ici se trouvera la classe Monstre.  Elle a 4 paramettre, url = le nom du fichier de sprite, c'est coordonné x et y et sa direction.
Ici on defini aussi la taille du Monstre
*/
function Monstre(url, x, y, direction) {
	this.x = x; // (en cases)
	this.y = y; // (en cases)
	this.direction = direction;

	// Chargement de l'image dans l'attribut image
	this.image = new Image();
	this.image.referenceDuPerso = this;

	this.image.onload = function() {
		if(!this.complete) 
		throw "Erreur de chargement du sprite nommé \"" + url + "\".";

		// Taille du Monstre
		this.referenceDuPerso.largeur = this.width / 4;
		this.referenceDuPerso.hauteur = this.height / 4;
	}

	this.image.src = "sprites/" + url;
}

Monstre.prototype.dessinerMonstre = function(context) {
	var frame = 0; // Numéro de l'image à prendre pour l'animation
    var decalageX = 0, decalageY = 0; // Décalage à appliquer à la position du Monstre
	if(this.etatAnimation >= DUREE_DEPLACEMENT) {
		// Si le déplacement a atteint ou dépassé le temps nécessaire pour s'effectuer, on le termine
		this.etatAnimation = -1;
	} else if(this.etatAnimation >= 0) {
			// On calcule l'image (frame) de l'animation à afficher
			frame = Math.floor(this.etatAnimation / DUREE_ANIMATION);
			if(frame > 3) {
					frame %= 4;
			}
	
			// Nombre de pixels restant à parcourir entre les deux cases
			var pixelsAParcourir = 32 - (32 * (this.etatAnimation / DUREE_DEPLACEMENT));
	
			// À partir de ce nombre, on définit le décalage en x et y.
			// NOTE : Si vous connaissez une manière plus élégante que ces quatre conditions, je suis preneur
			if(this.direction == DIRECTION.HAUT) {
				decalageY = pixelsAParcourir;
			} else if(this.direction == DIRECTION.BAS) {
				decalageY = -pixelsAParcourir;
			} else if(this.direction == DIRECTION.GAUCHE) {
				decalageX = pixelsAParcourir;
			} else if(this.direction == DIRECTION.DROITE) {
				decalageX = -pixelsAParcourir;
			}
	
			this.etatAnimation++;
	}
/*
 * Si aucune des deux conditions n'est vraie, c'est qu'on est immobile, 
 * donc il nous suffit de garder les valeurs 0 pour les variables 
 * frame, decalageX et decalageY
 */
	// Ici se trouvera le code de dessin du Monstre
	context.drawImage(
		this.image, 
		this.largeur * frame, this.direction * this.hauteur, // Point d'origine du rectangle source à prendre dans notre image
		this.largeur, this.hauteur, // Taille du rectangle source (c'est la taille du personnage)
		// Point de destination (dépend de la taille du personnage)
(this.x * 32) - (this.largeur / 2) + 16 + decalageX, (this.y * 32) - this.hauteur + 24 + decalageY,
		this.largeur, this.hauteur // Taille du rectangle destination (c'est la taille du personnage)
	);
}



	