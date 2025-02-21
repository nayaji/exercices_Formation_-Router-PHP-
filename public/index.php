<?php
declare(strict_types=1);

// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

// Connexion à la base de données
require_once "../app/models/connexion.php";

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    echo "Only GET requests are allowed!";
    exit;
}

try {
    // Récupérer la partie "path" de l'URL
    $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");

    // Définir l'URL de base
    $url_base = "PHP-router/public";  // Notez qu'il s'agit du chemin relatif à "public"

    // Gestion des vues en fonction de l'URL
    switch ($url_path) {
        case "":
        case $url_base:  // Accès à la page d'accueil
            require __DIR__ . "/../app/views/home.php";
            break;
        case $url_base . "/student":
            require __DIR__ . "/../app/views/student.php";
            break;
        case $url_base . "/add-student":
            require __DIR__ . "/../app/views/add-student.php";
            break;
        case $url_base . "/update-student":
            require __DIR__ . "/../app/views/update-student.php";
            break;
        case $url_base . "/delete-student":
            require __DIR__ . "/../app/views/delete-student.php";
            break;
        case $url_base . "/subscribe":
            require __DIR__ . "/../app/views/subscription.php";
            break;
        case $url_base . "/login":
            require __DIR__ . "/../app/views/login.php";
            break;
        case $url_base . "/logout":
            require __DIR__ . "/../app/views/logout.php";
            break;
        default:
            http_response_code(404);
            require __DIR__ . "/../app/views/404.php";
    }
} catch (Exception $e) {
    http_response_code(500);
    echo "Server error: " . $e->getMessage();
}
