<?php
require_once '../vendor/autoload.php';
use App\Page;
use App\Repo;

$page = new Page();
$repo = new Repo();

// Récupérer les données des utilisateurs depuis la base de données
$clients = $repo->getAllTable('Clients');

// Rendu du template Twig avec les données des utilisateurs
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Désactiver le cache pour le développement
]);

echo $twig->render('listClients.html.twig', [
    'msg' => null, // Vous pouvez passer un message ici si nécessaire
    'clients' => $clients,
    'isAdmin' => $page->session->isAdmin()
]);
?>
