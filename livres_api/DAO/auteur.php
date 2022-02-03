<?php
    include("db_connect.php");
    include("interfaces/DAO.php");
    global $conn;
    class AuteurDAO implements interfaceAuteur {
        public function addAuteur(string $prenom, string $nom) {
            $exist = R::find('personne', ' prenom = ? AND nom = ?', array($prenom, $nom));
            if (!$exist) {
                $personne = R::dispense('personne');
                $personne->prenom = $prenom;
                $personne->nom = $nom;
                $personne->auteur = 1;
                $res = R::store($personne);
                if ($res) {
                    return true;
                }
            }
            return false;
        }
        public function getAuteur(int $id) {
            return R::load('personne', $id);
        }
        public function getAuteurs() {
            return R::find( 'personne', ' auteur = 1 ');
        }
        public function getAuteurByLivre($id_livre) {
            $livre = R::load('livre', $id_livre);
            return R::load('personne', $livre->id_auteur);
        }
        public function updateAuteur(int $id, string $prenom, string $nom) {
            $auteur = R::load('personne', $id);
            $auteur->prenom = $prenom;
            $auteur->nom = $nom;
            $auteur->auteur = 1;
            $res = R::store($auteur);
            if ($res) {
                return true;
            }
        }
        public function deleteAuteur(int $id) {
            $personne = R::load('personne', $id);
            $res = R::trash($personne);
            if ($res) {
                return true;
            }
        }
    }
?>