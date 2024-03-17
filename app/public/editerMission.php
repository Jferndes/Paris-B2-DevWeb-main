<?php
require_once '../vendor/autoload.php';
use App\Page;
use App\Mission;
use App\Repo;

$page = new Page();
$repo = new Repo();
$mission = new Mission();

// Vérifier si un ID de mission est passé en paramètre
if (!isset($_GET['id'])) {
    // Rediriger vers une page d'erreur ou une autre page appropriée si l'ID de mission n'est pas fourni
    header("Location: erreur.php");
    exit();
}

// Récupérer l'ID de la mission depuis les paramètres de l'URL
$missionId = $_GET['id'];

// Récupérer les données de la mission à éditer depuis la base de données
$missionDetails = $mission->getMissionDetails($missionId);

// Vérifier si la mission existe
if (!$missionDetails) {
    // Rediriger vers une page d'erreur ou une autre page appropriée si la mission n'est pas trouvée
    header("Location: erreur.php");
    exit();
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $motif = $_POST["motif"];
    $urgence = $_POST["urgence"];
    $adresse = $_POST["adresse"];
    $commentaire = $_POST["commentaire"];
    $intervenants = $_POST["intervenants"];
    $standardiste = $_POST["standardiste"];
    $client = $_POST["client"];

    // Mettre à jour la mission dans la base de données
    $mission->updateMission($missionId, $motif, $urgence, $adresse, $commentaire, $intervenants, $standardiste, $client);

    // Rediriger vers une page de confirmation ou une autre page appropriée
    header("Location: confirmation.php");
    exit();
}

// Récupérer les données nécessaires pour pré-remplir le formulaire
$motif = $missionDetails['motif'];
$urgenceId = $missionDetails['urgence_id'];
$adresseId = $missionDetails['adresse_id'];
$commentaire = $missionDetails['commentaire'];
$intervenants = $mission->getIntervenantsMission($missionId);
$standardisteId = $missionDetails['standardiste_id'];
$client = $missionDetails['client_id'];

// Récupérer d'autres données nécessaires pour le formulaire
$urgences = $repo->getAllTable('UrgenceMission');
$adresses = $repo->getAllTable('Adresses');
$standardistes = $repo->getAllTable('Standardistes');
$clients = $repo->getAllTable('Clients');
$allIntervenants = $repo->getAllTable('Intervenants');

// Rendu du template Twig
echo $page->render('editer_mission.html.twig', [
    'missionId' => $missionId,
    'motif' => $motif,
    'urgenceId' => $urgenceId,
    'adresseId' => $adresseId,
    'commentaire' => $commentaire,
    'intervenants' => $intervenants,
    'standardisteId' => $standardisteId,
    'client' => $client,
    'urgences' => $urgences,
    'adresses' => $adresses,
    'standardistes' => $standardistes,
    'clients' => $clients,
    'allIntervenants' => $allIntervenants
]);
?>
