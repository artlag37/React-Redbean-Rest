<?php
    include("db_connect.php");
    include("interfaces/DAO.php");
    global $conn;
    class GenreDAO implements interfaceGenre{
        public function createGenre($id){
            $genre = R::dispense( 'genre' );
            $genre->nom = $id->getNom();
            $id = R::store( $genre );
        }
        public function updateGenre($id){
            $genre = R::load( 'genre', $id->getIdGenre());
            $genre->nom = $id->getNom();
            $id = R::store($genre);
        }
        public function deleteGenre($id){
            $genre = R::load('genre', $id);
            R::trash($genre);
        }
        public function getGenre($id){
            $genre = R::load( 'genre', $id);
            return $genre;
        }
        public function getGenres(){
            $vars = R::findAll('genre');
            return $vars;
        }
    }
?>