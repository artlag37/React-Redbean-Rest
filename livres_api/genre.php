<?php
// Connect to database
include("passerelle/db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];
function getGenres()
{
    global $conn;
    $query = "SELECT * FROM genre";
    //$response = array();
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function getGenre($id = 0)
{
    global $conn;
    $query = "SELECT * FROM genre";
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

function AddGenre()
{
    global $conn;
    $id = 1;
    $nom = $_POST["nom"];
    echo $query = "INSERT INTO genre(nom,id) VALUES('" . $nom . "', $id)";
    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Genre ajoute avec succes.'
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
function updateGenre($id)
{
    global $conn;
    $_PUT = array(); //tableau qui va contenir les données reçues
    parse_str(file_get_contents('php://input'), $_PUT);
    $nom = $_PUT["nom"];

    //construire la requête SQL
    $query = "UPDATE genre SET nom='" . $nom . "' WHERE id= $id";


    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Genre mis a jour avec succes.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Echec de la mise a jour de Genre. ' . mysqli_error($conn)
        );
    };

    header('Content-Type: application/json');
    echo json_encode($response);
}
function deleteGenre($id)
{
    global $conn;
    $query = "DELETE FROM genre WHERE id= $id";
    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Genre supprime avec succes.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'La suppression de Genre a echoue. ' . mysqli_error($conn)
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}


switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            // Récupérer un seul genre
            $id = intval($_GET["id"]);
            getGenre($id);
        } else {
            // Récupérer tous les genre
            getGenres();
        }
        break;
    case 'POST':
        // Ajouter un genre
        AddGenre();
        break;
    case 'PUT':
        // Modifier un genre
        $id = intval($_GET["id"]);
        updateGenre($id);
        break;
    case 'DELETE':
        // Supprimer un genre
        $id = 3;
        deleteGenre($id);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
