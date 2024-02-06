<?php
    require_once '../vendor/autoload.php';

    use App\Page;
    $page = new Page();
    $page->session->destroy();
    session_start();
    $page->session->addFlash("Vous vous êtes déconnecté", "danger");
    header("Location: index.php");
    exit();  
?>
