<?php 
define("DBHOST", "localhost");
define("DBNAME", "tp_todolist");
define("DBUSER", "root");
define("DBPASS", "");
define("DSN", "mysql:host=".DBHOST.";dbname=".DBNAME);
// $dns = "mysql:host=".DBHOST.";dbname=".DBNAME;
// $dns = "mysql:host=localhost;dbname=authors";
$option = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

// ? Connexion à la base de données
try{
    $conn = new PDO(DSN, DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion OK";
    $conn->beginTransaction();

} catch(PDOException $e){
    $conn->rollBack();
    die("Erreur : " .$e->getMessage());
}
