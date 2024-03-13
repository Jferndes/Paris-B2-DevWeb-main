<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    use App\Mission;
    use App\IntervenantsMission;
    use App\Repo;

    $page = new Page();
    $mission = new Mission();
    $intervenantsMission = new IntervenantsMission();

    // Récupérer les données depuis la base de données
    $missions = $repo->getAllTable('Missions');

    if (!$page->session->isConnected()) {
        header("Location: index.php");
        exit();
    }

    $Allmissions = $mission->getAllMission();

    var_dump($Allmissions);

    // Ajoutez une variable isAdmin à l'ensemble de données Twig
    $isAdmin = $page->session->isAdmin();

    echo $page->render('dashboard.html.twig', [
        'msg' => isset($_SESSION["flash"]) ? $page->session->getFlash() : false,
        'missions' => $Allmissions
        'isAdmin' => $isAdmin // Transmettez la variable isAdmin à Twig
    ]);

?>
