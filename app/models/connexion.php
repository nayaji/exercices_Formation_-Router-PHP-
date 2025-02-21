<?php
require_once "config.php";

try {
    // Création de la nouvelle instance PDO
    $db = new PDO("mysql:host=". $config['HOST'] .";dbname=".$config['DB'].";port=".$config['PORT'], $config['LOGIN'], $config['PASSWORD']);
    // Gérer les erreurs en mode exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    echo $e->getMessage();
}
?>
