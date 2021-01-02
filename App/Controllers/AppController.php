<?php 

namespace App\Controllers;

use MF\Model\Container;
use MF\Controller\Action;

class AppController extends Action{

    public function timeline(){
        $this->loginValidate();
    
        $tweet = Container::getModel('Tweet');
        $tweet->__set('id_user', $_SESSION['id']);
        $this->view->tweets = $tweet->getAll();

        $this->render('timeline');
    }

    public function tweet(){
        $this->loginValidate();

        $tweet = Container::getModel('Tweet');
        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_user', $_SESSION['id']);
        
        $tweet->save();

        header('Location: /timeline');
    }

    public function loginValidate(){
        session_start();
        if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['name']) || $_SESSION['name'] == '' ){
            header('Location: /?login=erro');
        }
    }

    public function whoToFollow(){
        $this->loginValidate();

        $searchName = isset($_GET['search']) ? $_GET['search'] : '';
        $users = array();
        
        if($searchName != ''){
            $user = Container::getModel('User');
            $user->__set('name', $searchName);
            $users = $user->getAll();
        }
      
        $this->view->users = $users;
        $this->render('whoToFollow');
    }
}