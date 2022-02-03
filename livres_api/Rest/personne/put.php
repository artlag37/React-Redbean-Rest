<?php
$url = "http://localhost/livres_api/personne/1";
$data = array('nom' => 'Dubois', 'prenom' => 'Eric','bibliotheque' => 'violet','auteur' => 1);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
$response = curl_exec($ch);
var_dump($response);
if (!$response) 
{
    return false;
}
?>