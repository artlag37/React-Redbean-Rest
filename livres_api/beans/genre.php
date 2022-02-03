<?php
class genre{

    private String $genre;

    

    function __construct(String $genre) {
    	$this->genre = $genre;
    }

    /**
    * @return String
    */
    public function getGenre(): String {
    	return $this->genre;
    }

    /**
    * @param String $genre
    */
    public function setGenre(String $genre): void {
    	$this->genre = $genre;
    }

    /**
    * @return string
    */
    public function __toString(): string {
    	return "Genre: {$this->genre}";
    }
}