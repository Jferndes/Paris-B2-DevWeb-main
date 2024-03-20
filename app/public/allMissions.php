<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    use App\Mission;
    use App\IntervenantsMission;
    use App\Repo;
    use App\Users;

    $page = new Page();
    $mission = new Mission();
    $user = new Users();

    if (!$page->session->isConnected()) {
        header("Location: index.php");
        exit();
    }

    $userId = $page->session->getUserId();

    echo $page->render('allMissions.html.twig', [
        'msg' => isset($_SESSION["flash"]) ? $page->session->getFlash() : false,
        'missions' => $mission->getAllMyMissions($userId),
        'prenom'  => $user->getUserPrenomById($userId),
        'isAdmin' => $page->session->isAdmin()
    ]);

?>
