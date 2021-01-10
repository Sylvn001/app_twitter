<?php 

namespace App\Controllers;

use MF\Model\Container;
use MF\Controller\Action;

class IndexController extends Action{

    public function index(){
        $this->view->login = isset($_GET['login']) ? $_GET['login'] : ''; 
        $this->render('index', 'layout');
    }

    public function subscribe(){
        $this->view->user = array(
            "name" => '',
            "email" => '',
            "password" => '',
        );
        $this->view->registerError = false; 
        $this->render('subscribe', 'layout');
    }

    public function register(){
        $user = Container::getModel('User');

        $defaultIconURL = "img/users/profile.png"; 

        $user->__set('name', $_POST['name']);
        $user->__set('email', $_POST['email']);
        $user->__set('aniversary', $_POST['aniversary']);
        $user->__set('password', md5($_POST['password']));
        $user->__set('image', $defaultIconURL);


        if($user->validateData() && count($user->getUserByEmail()) == 0  ){
            $user->save();
            $this->render('register');
        }

        else{
            $this->view->user = array(
                "name" => $_POST['name'],
                "email" => $_POST['email'],
                "aniversary" => $_POST['aniversary'],
                "password" => $_POST['password'],
            );

            $this->view->registerError = true; 
            $this->render('subscribe');
        }

    }

}                       