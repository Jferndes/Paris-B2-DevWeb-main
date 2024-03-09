<?php

require_once '../vendor/autoload.php';
use App\Page;
use App\Repo;

$page = new Page();
$repo = new Repo();

// Récupérer les données depuis la base de données
$missions = $repo->getAllTable('Mission');
$urgences = $repo->getAllTable('UrgenceMission');
$adresses = $repo->getAllTable('Adresses');
$commentaires = $repo->getAllTable('Commentaires');
$intervenants = $repo->getAllTable('Intervenants');
$standardistes = $repo->getAllTable('Standardistes');
$clients = $repo->getAllTable('Clients');

// Autres parties du code PHP

// Rendu du template Twig
echo $page->render('ajouter_mission.html.twig', [
    'missions' => $missions,
    'urgences' => $urgences,
    'adresses' => $adresses,
    'commentaires' => $commentaires,
    'intervenants' => $intervenants,
    'standardistes' => $standardistes,
    'clients' => $clients,
]);
