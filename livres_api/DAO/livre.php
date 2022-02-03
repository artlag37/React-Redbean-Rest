<?php
    include("db_connect.php");
    include("interfaces/DAO.php");
    global $conn;
    class LivreDAO implements interfaceLivre{
        public function addLivre(string $titre, int $id_auteur, $id_genre) {
            $exist = R::find('livre', ' titre = ? AND id_auteur = ?', array($titre, $id_auteur));
            if (!$exist) {
                $livre = R::dispense('livre');
                $livre->titre = $titre;
                $livre->id_auteur = $id_auteur;
                $livre->id_genre = $id_genre;
                $res = R::store($livre);
                if ($res) {
                    return true;
                }
            }
            return false;
        }
        public function getLivre(int $id) {
            return R::load('livre', $id);
        }
        public function getLivres() {
            return R::findAll('livre');
        }
        public function getLivresByGenre(int $id_genre) {
            return R::find( 'livre', ' genre = '.$id_genre);
        }
        public function getLivresByAuteur(int $id_auteur) {
            return R::find( 'livre', ' auteur = '.$id_auteur);
        }
        public function updateLivre(int $id, string $titre, int $id_auteur, $id_genre) {
            $livre = R::load('livre', $id);
            $livre->titre = $titre;
            $livre->id_auteur = $id_auteur;
            $livre->id_genre = $id_genre;
            $res = R::store($livre);
            if ($res) {
                return true;
            }
        }
        public function deleteLivre(int $id) {
            $livre = R::load('livre', $id);
            $res = R::trash($livre);
            if ($res) {
                return true;
            }
        }
    }
?>