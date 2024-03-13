<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    use App\Mission;
    use App\IntervenantsMission;
    $page = new Page();
    $mission = new Mission();
    $intervenantsMission = new IntervenantsMission();

    if(!$page->session->isConnected()) {
        header("Location: index.php");
        exit();
    };

    $Allmissions = $mission->getAllMission();

    var_dump($Allmissions);

    echo $page->render('dashboard.html.twig', [
        'msg' => isset($_SESSION["flash"]) ? $page->session->getFlash() : false,
        'missions' => $Allmissions
    ]);

?>