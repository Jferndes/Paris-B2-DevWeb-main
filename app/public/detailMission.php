<?php

require_once '../vendor/autoload.php';

use App\Page;
use App\Mission;
use App\IntervenantsMission;
use App\Users;

$page = new Page();
$missionModel = new Mission();
$intervenantsMissionModel = new IntervenantsMission();
$userModel = new Users();

// Redirection si l'utilisateur n'est pas connecté
if (!$page->session->isConnected()) {
    header("Location: index.php");
    exit();
}

$userId = $page->session->getUserId();

// Récupération des détails de la mission
$missionId = isset($_GET['mission_id']) ? (int)$_GET['mission_id'] : 0;
$mission = $missionModel->getAllInfoMission($missionId);

$adresseMission = $mission['AdresseNumero'] . ' ' . $mission['AdresseRue'] . ', ' . $mission['AdresseVille'] . ' ' . $mission['AdresseCodePostal'] . ', ' . $mission['AdressePays'];

// Récupération des intervenants associés à la mission
$intervenants = $intervenantsMissionModel->getIntervenantsByMissionId($missionId);

echo $page->render('detailMissions.html.twig', [
    'msg' => isset($_SESSION["flash"]) ? $page->session->getFlash() : false,
    'mission' => $mission,
    'adresseMission' => $adresseMission,
    'intervenants' => $intervenants,
    'isAdmin' => $page->session->isAdmin()
]);