<?php

namespace App;

class Session
{
    function __construct()
    {
        session_start();
    }

    public function add(string $key, $data)
    {
        $_SESSION[$key] = $data;
    }

    public function get(string $key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    }

    public function start()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public function destroy()
    {
        unset($_SESSION);
        session_destroy();
    }

    public function isConnected()
    {
        return isset($_SESSION['user']);
    }

    public function getUserId()
    {
        return isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
    }

    public function hasRole(string $role)
    {
        return $_SESSION['user']['role'] == $role ? true : false;
    }

    public function addFlash(string $msg, string $type)
    {
        $_SESSION["flash"]["msg"] = $msg;
        $_SESSION["flash"]["type"] = $type;
    }

    public function isAdmin()
    {
        return isset($_SESSION['user']['grade']) && $_SESSION['user']['grade'] == 1;
    }

    public function getFlash()
    {
        if(isset($_SESSION['flash'])){
            $flash = [$_SESSION["flash"]["msg"], $_SESSION["flash"]["type"]];
            unset($_SESSION["flash"]);
        }else{
            $flash = null;
        }
        return $flash;
    }
    

}