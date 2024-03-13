<?php
require_once '../vendor/autoload.php';
use App\Page;
use App\Repo;

$page = new Page();
$repo = new Repo();

// Récupérer les données des utilisateurs depuis la base de données
$users = $repo->getAllTable('Users');

// Rendu du template Twig avec les données des utilisateurs
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Désactiver le cache pour le développement
]);

echo $twig->render('listUser.html.twig', [
    'msg' => null, // Vous pouvez passer un message ici si nécessaire
    'users' => $users
]);
?>
