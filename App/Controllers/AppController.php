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

        $user = Container::getModel('User');
        $user->__set('id', $_SESSION['id']);

        $this->view->info_user       =  $user->getInfoUser();
        $this->view->total_tweets    =  $user->getTotalTweets();
        $this->view->total_following =  $user->getTotalFollowing();
        $this->view->total_followers =  $user->getTotalFollowers();

        $this->render('timeline');
    }

    public function tweet(){
        $this->loginValidate();

        $tweet = Container::getModel('Tweet');
        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_user', $_SESSION['id']);

        //insert image in post if exist
        if($_FILES['img']['name'] != "" && $_FILES['img']['error'] == 0){
            //verify file size 
            if($_FILES['img']['size'] > 1000000){
                header('Location: /timeline?erro=size');
                return;
            }

            //verify extension
            $fileExtension = basename($_FILES['img']['type']);
            $arrayExtensionsAllowed = ['jpg' , 'png' , 'gif' , 'jpeg'];

            if(!in_array($fileExtension,$arrayExtensionsAllowed)){
                header('Location: /timeline?erro=extension');
                return;
            }

            //directory contain all post of users
            $target_dir = "img/users/" . $_SESSION['id']  . '/posts/';

            //create dir with id of user and post dir if path not exist
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            //Generate Random Unique Name
            $fileName = $_SESSION['name'] . '_';
            $fileName .= date('H:m:s') . '_' . $_SESSION['id'];
            $fileName = str_replace(':' , "", $fileName);            
            
            //full string with path, name and extension
            $target_dir .= $fileName . ".". $fileExtension;
            $tweet->__set('image',$target_dir);

            move_uploaded_file($_FILES['img']['tmp_name'], $target_dir);
            $tweet->save();
        }else if($_POST['tweet'] != ""){
            $tweet->save();
        }

        header('Location: /timeline');

    }

    public function loginValidate(){
        session_start();
        if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['name']) || $_SESSION['name'] == '' ){
            header('Location: /?login=erro');
        }
    }

    public function aside(){
        $this->loginValidate();

        $searchName = isset($_GET['search']) ? $_GET['search'] : '';
        $users = array();
        
        if($searchName != ''){
            $user = Container::getModel('User');
            $user->__set('name', $searchName);
            $user->__set('id', $_SESSION['id']);
            $users = $user->getAll();
        }
      
        $this->view->users = $users;
        $this->render('aside');
    }

    public function action(){
        $this->loginValidate();

        $action = isset($_GET['act']) ? $_GET['act'] : '' ;
        $id_user_following = isset($_GET['id_user']) ? $_GET['id_user'] : '' ;

        $user = Container::getModel('User');
        $user->__set('id', $_SESSION['id']);

        if($action == 'follow'){
            $user->followUser($id_user_following);
        }else if($action == 'unfollow'){
            $user->unfollowUser($id_user_following);
        }

        header('Location: /who_to_follow');
        
    }
}