<?php
require_once(__DIR__ . '/require/connexion.php');

if (!empty($_GET['action'])) {
    $action = htmlspecialchars($_GET['action']);
    switch ($action) {
        case 'add':
            if (!empty($_POST['todoAdd'])) {
                $text = htmlspecialchars($_POST['todoAdd']);
                $sth = $conn->prepare("INSERT INTO todo(text) VALUES(:text)");
                $sth->bindParam(":text", $text);
                $sth->execute();
                header('location: index.php');
            } else {
                header('location: index.php');
            }
            break;
        case 'delete':
            if (!empty($_GET['id'])) {
                $id = $_GET['id'];
                $sth = "DELETE FROM todo WHERE id = '$id'";
                $conn->exec($sth);
                header('location: index.php');
            } else {
                header('location: index.php');
            }
            break;
        case 'checked':
            if (!empty($_GET['id'])) {
                $id = $_GET['id'];
                $sth = "SELECT * FROM todo WHERE id = '$id'";
                $sth = $conn->query($sth);
                $result = $sth->fetch(PDO::FETCH_ASSOC);
                if ($result['is_checked'] == false) {
                    $sth = "UPDATE todo SET is_checked = '1' WHERE id = '$id'";
                } else {
                    $sth = "UPDATE todo SET is_checked = '0' WHERE id = '$id'";
                }
                $conn->exec($sth);
                header('location: index.php');
            } else {
                header('location: index.php');
            }
            break;
        case 'deleteAll':
            $sth = "DELETE FROM todo";
            $conn->exec($sth);
            header('location: index.php');
            break;
    }
}
require_once(__DIR__ . '/require/deconnexion.php');