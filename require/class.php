<?php
require_once(__DIR__ . '/connexion.php');
date_default_timezone_set('Europe/Paris');

class Connexion
{
    protected $conn;
    protected $error;

    public function __construct()
    {
        try {
            $conn = new PDO(DSN, DBUSER, DBPASS);
            $this->conn = $conn;
        } catch (PDOException $e) {
            return $this->error = $e;
            echo "Erreur | Construct Connexion : " . $e->getMessage();
        }
    }
    public function getCon()
    {
        return $this->conn;
    }
    public function getError()
    {
        return $this->error;
    }
}

class Todo extends Connexion
{
    protected $conn;
    private $id;
    private $text;
    private $dateAjout;

    public function __construct($text)
    {
        $this->conn = new Connexion;
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
    public function getId()
    {
        return $this->id;
    }

    public function setId()
    {
        $connexion = new Connexion();
        $conn = $connexion->getCon();
        $sth = $conn->prepare("SELECT * FROM todo WHERE date_ajout = :dateAjout");
        $sth->bindParam(":dateAjout", $this->dateAjout);
        var_dump($this->dateAjout);
        if ($sth->execute()) {
            $id = $sth->fetch(PDO::FETCH_ASSOC);
            $this->id = $id['id'];
        } else {
            $erreur = $connexion->getError();
            die("Function setId() - Erreur : " . $erreur->getMessage());
        }
    }
    public function add()
    {
        $connexion = new Connexion();
        $conn = $connexion->getCon();
        $sth = $conn->prepare("INSERT INTO todo(text) VALUES(:text)");
        $sth->bindParam(":text", $this->text);
        $sth->execute();
        if ($sth->execute()) {
            $this->setId();
        } else {
            $erreur = $connexion->getError();
            die("Function setId() - Erreur : " . $erreur->getMessage());
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

$connexion = new Connexion;
var_dump($connexion);

$todo = new Todo("Test");
$todo->add();
print_r($conn);
