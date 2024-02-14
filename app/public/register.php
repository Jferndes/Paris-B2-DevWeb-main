<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    use App\Users;
    
    $page = new Page();
    $userObject = new Users();

    if (isset($_POST['creer'])) {
        // Detection erreur saisie
        if ($_POST['email'] == $_POST['email-cfg'] && $_POST['password'] == $_POST['password-cfg']) {
            // Detection Compte déja créé
            if ($userObject->isAlreadyCreated($_POST['email'])) {
                $page->session->addFlash("Le compte existe déjà !", "danger");
            } else {
                // Creation compte
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user = $userObject->insertUser([
                    'email'     => $_POST['email'],
                    'password'  => $hashedPassword
                ]);
                $page->session->addFlash("Compte Créé", "success");
                header("Location: index.php");
                exit();
            }
        } else {
            // Message erreur saisie
            $page->session->addFlash("L'email ou le mot de passe ne sont pas identique !", "danger");
        }
        
    }

    // Recuperation message flash
    $msg = isset($_SESSION["flash"]) ? $page->session->getFlash() : false;
    echo $page->render('register.html.twig', [
        'msg' => $msg
    ]);

?>