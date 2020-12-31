<?php 

namespace App\Controllers;

use MF\Model\Container;
use MF\Controller\Action;

class AuthController extends Action{

    public function auth(){
        $user = Container::getModel('user');

        $user->__set('email', $_POST['email']);
        $user->__set('password', $_POST['password']);

        $user->authenticate();

    }
}