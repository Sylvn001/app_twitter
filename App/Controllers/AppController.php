<?php 

namespace App\Controllers;

use MF\Model\Container;
use MF\Controller\Action;

class AppController extends Action{

    public function timeline(){
        session_start();
        
        if( isset($_SESSION['id']) && isset($_SESSION['name']) ){
            echo 'existe';
            $this->render('timeline');
        }else{
            header('Location: /?login=erro');
            header('Location: /?login=erro');
        }

    }

}