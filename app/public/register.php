<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_POST['send'])) {
        var_dump($_POST);
        if ($_POST['email'] == $_POST['email-cfg'] && $_POST['password'] == $_POST['password-cfg']) {
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            $page->insert('users', [
                'email'     => $_POST['email'],
                'password'  => $hashedPassword
            ]);

            header("Location: index.php");
        }
        
    }

    echo $page->render('register.html.twig', []);

?>