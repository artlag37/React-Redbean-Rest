<?php
// Connect to database
include("passerelle/db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];
function getPersonnes()
{
    global $conn;
    $query = "SELECT * FROM personne";
    //$response = array();
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function getPersonne($id = 0)
{
    global $conn;
    $query = "SELECT * FROM personne";
    if ($id != 0) {
        $query .= " WHERE id=" . $id . " LIMIT 1";
    }
    //$response = array();
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function AddPersonne()
{
    global $conn;
    $id = 3;
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $bibliotheque = $_POST["bibliotheque"];
    $auteur = $_POST["auteur"];
    echo $query = "INSERT INTO personne(id, nom, prenom, bibliotheque, auteur) VALUES($id, '" . $nom . "', '" . $prenom . "', '" . $bibliotheque . "', '" . $auteur . "')";
    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Personne ajoute avec succes.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'ERREUR!.' . mysqli_error($conn)
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
function updatePersonne($id)
{
    global $conn;
    $_PUT = array(); //tableau qui va contenir les données reçues
    parse_str(file_get_contents('php://input'), $_PUT);
    $nom = $_PUT["nom"];
    $prenom = $_PUT["prenom"];
    $bibliotheque = $_PUT["bibliotheque"];
    $auteur = $_PUT["auteur"];

    //construire la requête SQL
    $query = "UPDATE personne SET nom='" . $nom . "', prenom='" . $prenom . "', bibliotheque='" . $bibliotheque . "', auteur=' . $auteur . ' WHERE id=" . $id;


    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Personne mis a jour avec succes.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Echec de la mise a jour de Personne. ' . mysqli_error($conn)
        );
    };

    header('Content-Type: application/json');
    echo json_encode($response);
}
function deletePersonne($id)
{
    global $conn;
    $query = "DELETE FROM livre WHERE id=" . $id;
    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Personne supprime avec succes.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'La suppression de Personne a echoue. ' . mysqli_error($conn)
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}


switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            // Récupérer un seul produit
            $id = intval($_GET["id"]);
            getPersonne($id);
        } else {
            // Récupérer tous les produits
            getPersonnes();
        }
        break;
    case 'POST':
        // Ajouter un produit
        AddPersonne();
        break;
    case 'PUT':
        // Modifier un produit
        $id = intval($_GET["id"]);
        updatePersonne($id);
        break;
    case 'DELETE':
        // Supprimer un produit
        $id = 3;
        deletePersonne($id);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
