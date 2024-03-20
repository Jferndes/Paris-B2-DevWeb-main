<?php
require_once '../vendor/autoload.php';
use App\Page;
use App\Repo;

$page = new Page();
$repo = new Repo();

// Vérifiez si l'ID de la mission à supprimer est passé en tant que paramètre GET
if (isset($_GET['mission_id'])) {
    // Convertissez l'ID de la mission en entier
    $mission_id = (int)$_GET['mission_id'];

    // Appelez la méthode drop du repo pour supprimer la mission de la base de données
    $repo->drop('Missions', $mission_id);

    // Redirigez l'utilisateur vers une autre page après la suppression
    header("Location: dashboard.php");
    exit();
} else {
    // Redirigez l'utilisateur vers une autre page s'il manque l'ID de la mission
    header("Location: dashboard.php");
    exit();
}
?>
