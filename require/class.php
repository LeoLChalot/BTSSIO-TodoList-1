<?php
require_once(__DIR__ . '/connexion.php');
date_default_timezone_set('Europe/Paris');

class Todo
{

    private $id;
    private $text;
    private $dateAjout = null;

    public function __construct($text)
    {
        $this->text = $text;
        $date = new DateTime();
        $date->setTimezone(new \DateTimeZone('Europe/Paris'));
        $date = $date->format("Y/m/d H:i:s");
        $this->dateAjout = $date;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    private function setId(){
        $dns = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        try {
            $conn = new PDO($dns, DBUSER, DBPASS);
            $sth = $conn->prepare("SELECT id WHERE date_ajout = :datAjout");
            $sth->bindParam(":datAjout", $this->dateAjout);
            $id = $sth->execute();
            var_dump();
            $this->id = $id;
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function add()
    {
        $dns = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        try {
            $conn = new PDO($dns, DBUSER, DBPASS);
            $sth = $conn->prepare("INSERT INTO todo(text) VALUES(:text)");
            $sth->bindParam(":text", $this->text);
            $sth->execute();
            $this->setId();
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $dns = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        try {
            $conn = new PDO($dns, DBUSER, DBPASS);
            $sth = "DELETE FROM todo WHERE id = '$id'";
            $conn->exec($sth);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}

// $testTodo = new Todo("Ceci est un test !");

// echo $testTodo->getText() . "<br>";
// echo $testTodo->getDateAjout() . "<br>";
