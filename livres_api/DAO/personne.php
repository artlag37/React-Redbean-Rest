<?php
    include("db_connect.php");
    include("interfaces/DAO.php");
    global $conn;
    class PersonneDAO implements interfacePersonne{
        public function addPersonne(string $prenom, string $nom) {
            $exist = R::find('personne', ' prenom = ? AND nom = ?', array($prenom, $nom));
            if (!$exist) {
                $personne = R::dispense('personne');
                $personne->prenom = $prenom;
                $personne->nom = $nom;
                $personne->auteur = 0;
                $res = R::store($personne);
                if ($res) {
                    return true;
                }
            }
            return false;
        }
        public function getPersonne(int $id) {
            return R::load('personne', $id);
        }
        public function getPersonnes() {
            return R::findAll('personne');
        }
        public function updatePersonne(int $id, string $prenom, string $nom, int $auteur) {
            $personne = R::load('personne', $id);
            $personne->prenom = $prenom;
            $personne->nom = $nom;
            $personne->auteur = $auteur;
            $res = R::store($personne);
            if ($res) {
                return true;
            }
        }
        public function deletePersonne(int $id) {
            $personne = R::load('personne', $id);
            $res = R::trash($personne);
            if ($res) {
                return true;
            }
        }
    }
?>