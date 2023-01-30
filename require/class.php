<?php 
date_default_timezone_set('Europe/Paris');

class Todo{

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

    public function getText(){
        return $this->text;
    }

    public function getDateAjout(){
        return $this->dateAjout;
    }

    public function delete(){

    }
    

}

$testTodo = new Todo("Ceci est un test !");

echo $testTodo->getText(). "<br>";
echo $testTodo->getDateAjout(). "<br>";
