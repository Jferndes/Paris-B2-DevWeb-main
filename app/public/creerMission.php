<?php
require_once '../vendor/autoload.php';
use App\Page;
use App\Repo;

$page = new Page();
$repo = new Repo();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Utilisez $page->session->userID() pour obtenir l'ID de l'utilisateur
    $user_id = $page->session->getUserId();

    // Récupérer les données du formulaire pour la table Commentaires
    $commentaireData = [
        'commentaire' => $_POST['commentaire'],
        'user_id' => $user_id // Utilisation de l'ID de l'utilisateur
    ];

    // Insérer les données dans la table Commentaires
    $commentaire_id = $repo->insert('Commentaires', $commentaireData);

    // Récupérer les autres données du formulaire pour la table Missions
    $missionData = [
        'motif' => $_POST['motif'],
        'urgence_id' => $_POST['urgence'],
        'adresse_id' => $_POST['adresse'],
        'standardiste_id' => $_POST['standardiste'],
        'client_id' => $_POST['client'],
        'statut_id' => 1, // Valeur par défaut pour l'état "Demande"
        'commentaire_id' => $commentaire_id // Utilisation de l'ID du commentaire nouvellement inséré
    ];

    // Insérer les données dans la table Missions
    $mission_id = $repo->insert('Missions', $missionData);

    // Gérer les intervenants (supposons qu'il y ait une table de relation Intervenants_Missions)

    // Redirection vers une autre page après l'insertion (facultatif)
    header("Location: dashboard.php");
    exit();
}

// Récupérer les données depuis la base de données pour afficher dans le formulaire
$urgences = $repo->getAllTable('UrgenceMission');
$adresses = $repo->getAllTable('Adresses');
$standardistes = $repo->getAllTable('Standardistes');
$clients = $repo->getAllTable('Clients');
$intervenants = $repo->getAllTable('Intervenants');

// Rendu du template Twig
echo $page->render('ajouter_mission.html.twig', [
    'urgences' => $urgences,
    'adresses' => $adresses,
    'standardistes' => $standardistes,
    'clients' => $clients,
    'intervenants' => $intervenants
]);
?>
