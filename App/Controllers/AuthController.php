<?php 

namespace App\Controllers;

use MF\Model\Container;
use MF\Controller\Action;

class AuthController extends Action{

    public function auth(){
        $user = Container::getModel('user');

        $user->__set('email', $_POST['email']);
        $user->__set('password', md5($_POST['password']));

        $user->authenticate(); 
      
       if($user->__get('id') != '' && $user->__get('name') != ''){
           session_start();

           $_SESSION['id'] = $user->__get('id');
           $_SESSION['name'] = $user->__get('name');

           header('Location: /timeline');

       }else{
           header('Location: /?login=erro');
       }

    }

    public function loggout(){
        session_start();
        session_destroy();
        header('Location: /');
    }
}