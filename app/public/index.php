<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    use App\Users;
    
    $page = new Page();
    $userObject = new Users();

    if (isset($_POST['connexion'])) {
        $user = $userObject->getUserByEmail([
            'email' => $_POST['email']
        ]);

        if (!$user) {
            $page->session->addFlash("Email ou mot de passe incorrect !", "danger");
        } else {
            if (!password_verify($_POST['password'], $user['password'])) {
                $page->session->addFlash("Email ou mot de passe incorrect !", "danger");
            } else {
                $page->session->add('user', []);
                $page->session->addFlash("Bienvenue", "success");
                header("Location: dashboard.php");
                exit();
            }
        }
    }

    $msg = isset($_SESSION["flash"]) ? $page->session->getFlash() : false;
    echo $page->render('index.html.twig', [
        'msg' => $msg
    ]);

?>