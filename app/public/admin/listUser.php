<?php

    require_once '../../vendor/autoload.php';

    use App\Page;
    use App\Users;
    
    $page = new Page();
    $userObject = new Users();

    $users = $userObject->getAllUsers();

    echo $page->render('listUser.html.twig', [
        'users' => $users
    ]);