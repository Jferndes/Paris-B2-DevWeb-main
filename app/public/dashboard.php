<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    use App\Mission;
    use App\IntervenantsMission;
    use App\Repo;

    $page = new Page();
    $mission = new Mission();
    $intervenantsMission = new IntervenantsMission();

    if (!$page->session->isConnected()) {
        header("Location: index.php");
        exit();
    }

    $userData = [
        'userId' => $page->session->getUserId()
    ];

    echo $page->render('dashboard.html.twig', [
        'msg' => isset($_SESSION["flash"]) ? $page->session->getFlash() : false,
        'missions' => $mission->getMyMissions($userData),
        'isAdmin' => $page->session->isAdmin()
    ]);

?>
