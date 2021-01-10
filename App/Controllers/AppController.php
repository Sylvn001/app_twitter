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
        $this->view->image =            $user->getProfileImage();

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

    public function whoToFollow(){
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
        $this->render('whoToFollow');
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

    public function deletePost(){
        $this->loginValidate();

        $tweet = Container::getModel('Tweet');

        $tweet->__set('id_user', $_SESSION['id']);
        $tweet->__set('id', $_POST['id_tweet']);

        //destroy file
        $fileName = $tweet->getTweetImage();

        if(file_exists($fileName)){
            unlink($fileName);
        }

        $tweet->destroy();

        return header('Location: /timeline');

    }

    public function profile(){
        $this->loginValidate();
    
        $tweet = Container::getModel('Tweet');
        $tweet->__set('id_user', $_GET['id']);
        $this->view->tweets = $tweet->getUserAll();

        $user = Container::getModel('User');
        $user->__set('id', $_GET['id']);

        $this->view->info_user       =  $user->getInfoUser();
        $this->view->total_tweets    =  $user->getTotalTweets();
        $this->view->total_following =  $user->getTotalFollowing();
        $this->view->total_followers =  $user->getTotalFollowers();
        $this->view->image =            $user->getProfileImage();
        $this->view->location =            $user->getProfileLocation();
        $this->view->aniversary =            $user->getProfileAniversary();
        $this->view->bio =            $user->getProfileBio();

        $this->render('profile');
    }

    public function update(){
        $this->loginValidate();

        echo '<pre>';

        $user = Container::getModel('User');
        $user->__set('id', $_SESSION['id']);
        $user->__set('bio', $_POST['bio']);
        $user->__set('name', $_POST['name']);
        $user->__set('location', $_POST['location']);
        $user->__set('aniversary', $_POST['aniversary']);
        
        if($_FILES['img']['name'] != ""){
               //verify file size 
            if($_FILES['img']['size'] > 1000000){
                header("Location: /profile?id={$_SESSION['id']}");
                return;
            }

            //verify extension
            $fileExtension = basename($_FILES['img']['type']);
            $arrayExtensionsAllowed = ['jpg' , 'png' , 'gif' , 'jpeg'];

            if(!in_array($fileExtension,$arrayExtensionsAllowed)){
                header("Location: /profile?id={$_SESSION['id']}");
                return;
            }


            $target_dir = "img/users/{$_SESSION['id']}/profile/";

            if(!file_exists($target_dir)){
                mkdir($target_dir);
            } 

            $fileName = "profile_user_" . $_SESSION['id'] . "." . $fileExtension;
            $urlPath = $target_dir . basename($fileName);

            if (move_uploaded_file($_FILES["img"]["tmp_name"], $urlPath)) {
                $user->__set('image', $urlPath);
            }else{
                return;
            }

        }else{
            $imageURL = $user->getProfileImage()['image'];
            $user->__set('image', $imageURL);
        }

        $user->update();
        header("location: /profile?id={$_SESSION['id']}");
    }
}