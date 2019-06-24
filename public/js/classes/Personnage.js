var DIRECTION = {
	"BAS"    : 0,
	"GAUCHE" : 1,
	"DROITE" : 2,
	"HAUT"   : 3
}
var DUREE_ANIMATION = 4;
var DUREE_DEPLACEMENT = 15;
this.etatAnimation = -1;

const sleep = (milliseconds) => {
  return new Promise(resolve => setTimeout(resolve, milliseconds))
}
/*
Ici se trouvera la classe Personnage.  Elle a 4 paramettre, url = le nom du fichier de sprite, c'est coordonné x et y et sa direction.
Ici on defini aussi la taille du personnage
*/
function Personnage(url, x, y, direction) {
	this.x = x; // (en cases)
	this.y = y; // (en cases)
	this.direction = direction;

	// Chargement de l'image dans l'attribut image
	this.image = new Image();
	this.image.referenceDuPerso = this;

	this.image.onload = function() {
		if(!this.complete) 
		throw "Erreur de chargement du sprite nommé \"" + url + "\".";

		// Taille du personnage
		this.referenceDuPerso.largeur = this.width / 4;
		this.referenceDuPerso.hauteur = this.height / 4;
	}

	this.image.src = "sprites/" + url;
}

// Exécute un appel AJAX POST
// Prend en paramètres l'URL cible, la donnée à envoyer et la fonction callback appelée en cas de succès
function ajaxPost(url, data, callback) {
    var req = new XMLHttpRequest();
    req.open("POST", url);
    req.addEventListener("load", function () {
        if (req.status >= 200 && req.status < 400) {
            // Appelle la fonction callback en lui passant la réponse de la requête
            callback(req.responseText);
        } else {
            console.error(req.status + " " + req.statusText + " " + url);
        }
    });
    req.addEventListener("error", function () {
        console.error("Erreur réseau avec l'URL " + url);
    });
    req.send(data);
}


Personnage.prototype.dessinerPersonnage = function(context) {
	var frame = 0; // Numéro de l'image à prendre pour l'animation
    var decalageX = 0, decalageY = 0; // Décalage à appliquer à la position du personnage
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
	// Ici se trouvera le code de dessin du personnage
	context.drawImage(
		this.image, 
		this.largeur * frame, this.direction * this.hauteur, // Point d'origine du rectangle source à prendre dans notre image
		this.largeur, this.hauteur, // Taille du rectangle source (c'est la taille du personnage)
		// Point de destination (dépend de la taille du personnage)
(this.x * 32) - (this.largeur / 2) + 16 + decalageX, (this.y * 32) - this.hauteur + 24 + decalageY,
		this.largeur, this.hauteur // Taille du rectangle destination (c'est la taille du personnage)
	);
}


/*ICI on dit ce qui se passe avec les coordonnées en fontion des direction*/
Personnage.prototype.getCoordonneesAdjacentes = function(direction)  {
	var coord = {'x' : this.x, 'y' : this.y};
	switch(direction) {
		case DIRECTION.BAS : 
			coord.y++;
			break;
		case DIRECTION.GAUCHE : 
			coord.x--;
			break;
		case DIRECTION.DROITE : 
			coord.x++;
			break;
		case DIRECTION.HAUT : 
			coord.y--;
			break;
	}
	return coord;
}
	
Personnage.prototype.deplacer = function(direction, map) {
	// On ne peut pas se déplacer si un mouvement est déjà en cours !
if(this.etatAnimation >= 0) {
	return false;
}
	// On change la direction du personnage
	this.direction = direction;
		
	// On vérifie que la case demandée est bien située dans la carte
	var prochaineCase = this.getCoordonneesAdjacentes(direction);
	if(prochaineCase.x < 0 || prochaineCase.y < 0 || prochaineCase.x >= map.getLargeur() || prochaineCase.y >= map.getHauteur()) {
		// On retourne un booléen indiquant que le déplacement ne s'est pas fait, 
		// Ça ne coute pas cher et ca peut toujours servir
		return false;
	}
	/*quiz*/
	var quiz = document.getElementById('quizz');
	
	sleep(700).then(() => { if (etatAnimation == -1) {
		if (prochaineCase.x === monstre.x && prochaineCase.y === monstre.y) {
			//demande d'info des questions
			var arrayID = new FormData();
			arrayID.append("id", "2");
			// Envoi de l'objet FormData au serveur
			ajaxPost("/api/test2/2", arrayID,
	    		function (reponse) {
	        		// Affichage dans la console en cas de succès
	        		console.log("Commande envoyée au serveur");
	        		alert(reponse);
	    		}
			);

			//avec battle
			//demande d'info des questions
			var arrayID = new FormData();
			arrayID.append("id", "3");
			// Envoi de l'objet FormData au serveur
			ajaxPost("/api/battle/3", arrayID,
	    		function (reponse) {
	        		// Affichage dans la console en cas de succès
	        		console.log("Commande envoyée au serveur");
	        		alert(reponse);
	    		}
			);

			quiz.classList.remove("none");

			}else{
				console.log("ERREUR 404");
			}

	}});
		
	// On effectue le déplacement
	this.x = prochaineCase.x;
	this.y = prochaineCase.y;
	this.etatAnimation = 1;	
	return true;
}