<?php
class livre{

    public String $titre;
    public array $genre;
    public Auteur $auteur;
    
    

    function __construct(String $titre, array $genre, Auteur $auteur) {
    	$this->titre = $titre;
    	$this->genre = $genre;
    	$this->auteur = $auteur;
    
    }

    /**
    * @return String
    */
    public function getTitre(): String {
    	return $this->titre;
    }

    /**
    * @param String $titre
    */
    public function setTitre(String $titre): void {
    	$this->titre = $titre;
    }

    /**
    * @return array
    */
    public function getGenre(): array {
    	return $this->genre;
    }

    /**
    * @param array $genre
    */
    public function setGenre(array $genre): void {
    	$this->genre = $genre;
    }

    /**
    * @return Auteur
    */
    public function getAuteur(): Auteur {
    	return $this->auteur;
    }

    /**
    * @param Auteur $auteur
    */
    public function setAuteur(Auteur $auteur): void {
    	$this->auteur = $auteur;
    }
}