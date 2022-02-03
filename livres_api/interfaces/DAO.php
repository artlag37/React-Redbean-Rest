<?php

interface interfacePersonne {
	public function addPersonne(string $prenom, string $nom);
	public function getPersonne(int $id);
	public function getPersonnes();
	public function updatePersonne(int $id, string $prenom, string $nom, int $auteur);
	public function deletePersonne(int $id);
}

interface interfaceAuteur {
	public function AddAuteur(string $prenom, string $nom);
	public function getAuteur(int $id);
	public function getAuteurs();
	public function getAuteurByLivre($id_livre);
	public function updateAuteur(int $id, string $prenom, string $nom);
	public function deleteAuteur(int $id);
}

interface interfaceLivre {
	public function addLivre(string $titre, int $id_auteur, $id_genre);
	public function getLivre(int $id);
	public function getLivres();
	public function getLivresByGenre(int $id_genre);
	public function getLivresByAuteur(int $id_auteur);
	public function updateLivre(int $id, string $titre, int $id_auteur, $id_genre);
	public function deleteLivre(int $id);
}

interface interfaceGenre {
	public function createGenre($id);
	public function getGenre($id);
	public function getGenres();
	public function updateGenre($id);
	public function deleteGenre($id);
}

?>