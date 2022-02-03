<?php
class auteur extends personne{
    
    static String $nom;
    static String $oeuvre;

    function __construct(String $nom, String $oeuvre) {
    	$this->nom = $nom;
    	$this->oeuvre = $oeuvre;
    }

    

    /**
    * @return String
    */
    public function getNom(): String {
    	return $this->nom;
    }

    /**
    * @param String $nom
    */
    public function setNom(String $nom): void {
    	$this->nom = $nom;
    }

    /**
    * @return String
    */
    public function getOeuvre(): String {
    	return $this->oeuvre;
    }

    /**
    * @param String $oeuvre
    */
    public function setOeuvre(String $oeuvre): void {
    	$this->oeuvre = $oeuvre;
    }
}