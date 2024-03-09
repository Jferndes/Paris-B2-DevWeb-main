<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    $page = new Page();

    if(!$page->session->isConnected()) {
        header("Location: index.php");
        exit();
    };

    $msg = isset($_SESSION["flash"]) ? $page->session->getFlash() : false;

    echo $page->render('dashboard.html.twig', [
        'msg' => $msg
    ]);

?>