<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    use App\User;
    
    $page = new Page();
    $userObject = new User();

    $msg = isset($_SESSION["flash"]) ? $page->session->getFlash() : false;

    if (isset($_POST['connexion'])) {
        $user = $userObject->getUserByEmail([
            'email' => $_POST['email']
        ]);

        if (!$user) {
            $msg = "Email ou mot de passe incorrect !";
        } else {
            if (!password_verify($_POST['password'], $user['password']) ) {
                $msg = "Email ou mot de passe incorrect !";
            } else {
                $page->session->add('user', []);
                $page->session->addFlash("Bienvenue", "success");
                header("Location: dashboard.php");
                exit();
            }
        }
    }

    echo $page->render('index.html.twig', [
        'msg' => $msg
    ]);

?>