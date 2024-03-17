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

    if ($page->session->isAdmin()) {
        $missions = $mission->getAllMission();
    } else {
        $missions = $mission->getAllMissionForUser($user_id);
    }

    echo $page->render('dashboard.html.twig', [
        'msg' => isset($_SESSION["flash"]) ? $page->session->getFlash() : false,
        'missions' => $missions,
        'isAdmin' => $page->session->isAdmin()
    ]);
?>
