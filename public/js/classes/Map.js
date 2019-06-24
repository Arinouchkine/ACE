
function Map(nom) {
	
	// Création de l'objet XmlHttpRequest
	var xhr = new XMLHttpRequest();
	// Chargement du fichier on indique que la map se situe dans maps et que le nom est le nom du fichier map
	xhr.open("GET", './maps/' + nom + '.json', false);
	xhr.send(null);
	if(xhr.readyState != 4 || (xhr.status != 200 && xhr.status != 0)) // Code == 0 en local
	throw new Error("Impossible de charger la carte nommée \"" + nom + "\" (code HTTP : " + xhr.status + ").");
	var mapJsonData = xhr.responseText;
	// Analyse des données
	var mapData = JSON.parse(mapJsonData);
	this.tileset = new Tileset(mapData.tileset);
	this.terrain = mapData.terrain;
	this.personnages = new Array();
	this.monstres = new Array();
	/*Pour le monstre*/ 

}

// Pour récupérer la taille (en tiles) de la carte
Map.prototype.getHauteur = function() {
return this.terrain.length;
}

Map.prototype.getLargeur = function() {
return this.terrain[0].length;
}




// Pour ajouter un personnage dans le tableau personnage
Map.prototype.addPersonnage = function(perso) {
this.personnages.push(perso);
}

//Pour ajouter un monstre dans le tableau monstre
Map.prototype.addMonstre = function(monstre) {
this.monstres.push(monstre);
}

//On dessine la map
Map.prototype.dessinerMap = function(context) {
	for(var i = 0, l = this.terrain.length ; i < l ; i++) {
		var ligne = this.terrain[i];
		var y = i * 32;
			for(var j = 0, k = ligne.length ; j < k ; j++) {
			this.tileset.dessinerTile(ligne[j], context, j * 32, y);
			}
	}

	// Liste des personnages présents sur le terrain.
	for(var i = 0, l = this.personnages.length ; i < l ; i++) {
	this.personnages[i].dessinerPersonnage(context);
	}

	// Liste des monstres présents sur le terrain.
	for(var i = 0, l = this.monstres.length ; i < l ; i++) {
	this.monstres[i].dessinerMonstre(context);
	}

}



