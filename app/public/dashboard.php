<?php
require_once '../vendor/autoload.php';

use App\Page;
use App\Mission;
use App\IntervenantsMission;
use App\Repo;

$page = new Page();
$mission = new Mission();
$intervenantsMission = new IntervenantsMission();
$user_id = $page->session->getUserId();

if (!$page->session->isConnected()) {
    header("Location: index.php");
    exit();
}

// Récupérer toutes les missions (ou celles de l'utilisateur connecté si ce n'est pas un administrateur)
if ($page->session->isAdmin()) {
    $missions = $mission->getAllMission();
} else {
    $missions = $mission->getAllMissionForUser($user_id);
}

// Vérifier si des missions ont été récupérées
/*
if ($missions) {
    // Parcourir chaque mission
    foreach ($missions as $mission) {
        // Récupérer le numéro de dossier de chaque mission à partir de la base de données
        $missionDetails = $mission->getMissionDetails(); // Assurez-vous que cette méthode est correctement définie dans la classe Mission
        $numeroDossier = $missionDetails->getNumeroDossier(); // Assurez-vous que cette méthode est correctement définie dans la classe MissionDetails
        // Ajouter le numéro de dossier à la mission
        $mission->setNumeroDossier($numeroDossier); // Assurez-vous que cette méthode est correctement définie dans la classe Mission
    }
}
*/

echo $page->render('dashboard.html.twig', [
    'msg' => isset($_SESSION["flash"]) ? $page->session->getFlash() : false,
    'missions' => $missions,
    'isAdmin' => $page->session->isAdmin()
]);
?>
