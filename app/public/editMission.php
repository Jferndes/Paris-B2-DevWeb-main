<?php
require_once '../vendor/autoload.php';
use App\Page;
use App\Repo;

$page = new Page();
$repo = new Repo();
$mission_id = isset($_GET['mission_id']) ? (int)$_GET['mission_id'] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données mises à jour du formulaire
    $motif = $_POST['motif'];
    $urgence_id = $_POST['urgence'];
    $adresse_id = $_POST['adresse'];
    $commentaire = $_POST['commentaire'];
    $intervenants = $_POST['intervenants']; // Notez que c'est un tableau s'il y a plusieurs intervenants
    $standardiste_id = $_POST['standardiste'];
    $client_id = $_POST['client'];

    // Mettre à jour les données de la mission dans la base de données
    $missionData = [
        'motif' => $motif,
        'urgence_id' => $urgence_id,
        'adresse_id' => $adresse_id,
        // Ajoutez d'autres champs à mettre à jour de la même manière
    ];

    // Utiliser la méthode update du repo pour mettre à jour les données de la mission
    $repo->update('Missions', $missionData, $mission_id);

    // Redirection vers une autre page après la mise à jour
    header("Location: dashboard.php");
    exit();
}

$mission = $repo->getOneById('Missions', $mission_id);

$urgences = $repo->getAllTable('UrgenceMission');
$adresses = $repo->getAllTable('Adresses');
$standardistes = $repo->getAllTable('Standardistes');
$clients = $repo->getAllTable('Clients');
$intervenants = $repo->getAllTable('Intervenants');

// Rendu du template Twig
echo $page->render('edit_mission.html.twig', [
    'mission' => $mission,
    'urgences' => $urgences,
    'adresses' => $adresses,
    'standardistes' => $standardistes,
    'clients' => $clients,
    'intervenants' => $intervenants
]);
?>
