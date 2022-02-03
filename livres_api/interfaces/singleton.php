<?php
package com.developpez.jdbc;

import java.sql.*;

class ConnectionPostgreSQL{

    /**
     * URL de connexion
     */
    private static String $url = "jdbc:postgresql://localhost:5432/Societe";
    /**
     * Nom du user
     */
    private static String $user = "postgres";
    /**
     * Mot de passe du user
     */
    private static String $passwd = "postgres";
    /**
     * Objet Connexion
     */
    private static Connection $connect;
    
    /**
     * Méthode qui va nous retourner notre instance
     * et la créer si elle n'existe pas...
     * @return
     */
    public function getInstance():Connection {
        if($connect == null){
            try {
                $connect = DriverManager.getConnection($url, $user, $passwd);
            } catch (SQLException $e) {
                $e.printStackTrace();
            }
        }        
        return $connect;    
    }    
}
?>