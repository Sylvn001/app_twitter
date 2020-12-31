<?php 

namespace App\Controllers;

use MF\Model\Container;
use MF\Controller\Action;

class IndexController extends Action{

    public function index(){
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

        $user->__set('name', $_POST['name']);
        $user->__set('email', $_POST['email']);
        $user->__set('password', $_POST['password']);

        if($user->validateData() && count($user->getUserByEmail()) == 0  ){
            $user->save();
            $this->render('register');
        }

        else{
            $this->view->user = array(
                "name" => $_POST['name'],
                "email" => $_POST['email'],
                "password" => $_POST['password'],
            );

            $this->view->registerError = true; 
            $this->render('subscribe');
        }

    }

}                       