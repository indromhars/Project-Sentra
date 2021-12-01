<?php
//Start the session first
ob_start();
session_start();

try {
    function connectDatabase(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "CRUD";

        return new PDO("mysql:host=$servername;dbname={$dbName};port=3307", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    function runQuery($query, $parameters = null){
        $connection = connectDatabase();
        $q = $connection->prepare($query);
        $q->execute($parameters);

        return $q;
    }

    function isUser(){
        return isset ($_SESSION["id"]);
    }

    require 'pages/template.php';

} catch(PDOException $e) {
    echo "Connection failed " . $e->getMessage();
}