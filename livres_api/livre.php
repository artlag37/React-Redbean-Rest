<?php
// Connect to database
include("passerelle/db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];
function getLivres()
{
    global $conn;
    $query = "SELECT * FROM livre";
    //$response = array();
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}
function getLivre($id = 0)
{
    global $conn;
    $query = "SELECT * FROM livre";
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
function AddLivre()
{
    global $conn;
    $id = 7;
    $titre = $_POST["titre"];
    $id_auteur = $_POST["id_auteur"];
    echo $query = "INSERT INTO livre(id, titre, id_auteur) VALUES('" . $id . "', '" . $titre . "', '" . $id_auteur . "')";
    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Livre ajoute avec succes.'
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
function updateLivre($id)
{
    global $conn;
    $_PUT = array(); //tableau qui va contenir les données reçues
    parse_str(file_get_contents('php://input'), $_PUT);
    $titre = $_PUT["titre"];
    $id_auteur = $_PUT["id_auteur"];

    //construire la requête SQL
    $query = "UPDATE livre SET titre='" . $titre . "', id_auteur='" . $id_auteur . "' WHERE id=" . $id;


    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Livre mis a jour avec succes.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Echec de la mise a jour de livre. ' . mysqli_error($conn)
        );
    };

    header('Content-Type: application/json');
    echo json_encode($response);
}
function deleteLivre($id)
{
    global $conn;
    $query = "DELETE FROM livre WHERE id=" . $id;
    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Livre supprime avec succes.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'La suppression du livre a echoue. ' . mysqli_error($conn)
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
            getLivre($id);
        } else {
            // Récupérer tous les produits
            getLivres();
        }
        break;
    case 'POST':
        // Ajouter un produit
        AddLivre();
        break;
    case 'PUT':
        // Modifier un produit
        $id = intval($_GET["id"]);
        updateLivre($id);
        break;
    case 'DELETE':
        // Supprimer un produit
        $id = intval($_GET["id"]);
        deleteLivre($id);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
