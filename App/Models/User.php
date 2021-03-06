<?php 

namespace App\Models;

use MF\Model\Model;

class User extends Model{
  
   private $id;
   private $name;
   private $email;
   private $password;
   private $bio;
   private $location;
   private $aniversary;
   private $image;

   public function __get($attr){
       return $this->$attr;
   }

   public function __set($attr, $value){
       $this->$attr = $value;
   }

   //save
   public function save(){
       $sql = "INSERT INTO users (name, email, aniversary, password, image) values (:name , :email, :aniversary, :password, :image)";
       $stmt = $this->db->prepare($sql);
       $stmt->bindValue(':name' , $this->__get('name'));
       $stmt->bindValue(':email', $this->__get('email'));
       $stmt->bindValue(':aniversary', $this->__get('aniversary'));
       $stmt->bindValue(':password', $this->__get('password'));
       $stmt->bindValue(':image', $this->__get('image'));
       $stmt->execute();
       return $this;
   }

   public function update(){
    $sql = "UPDATE users SET name = :name, bio = :bio, location = :location, image = :image, aniversary = :aniversary WHERE id = :id;";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':name' , $this->__get('name'));
    $stmt->bindValue(':bio', $this->__get('bio'));
    $stmt->bindValue(':location', $this->__get('location'));
    $stmt->bindValue(':image', $this->__get('image'));
    $stmt->bindValue(':aniversary', $this->__get('aniversary'));
    $stmt->bindValue(':id', $this->__get('id'));
    $stmt->execute();
    return $this;
    }

   //validate
   public function validateData(){
       $validate = true; 

       if(strlen($this->__get('name')) < 3 ){
           $validate = false;
       }

       if(strlen($this->__get('email')) < 12 ){
           $validate = false;
       }

       if(strlen($this->__get('password')) < 6 ){
           $validate = false;
       }

       return $validate; 
   }

   //recovery email and name
   public function getUserByEmail(){
       $sql = "SELECT name, email FROM users WHERE email = :email";
       $stmt =  $this->db->prepare($sql);
       $stmt->bindValue('email', $this->__get('email'));
       $stmt->execute();

       return $stmt->fetchAll(\PDO::FETCH_ASSOC);
   }
     
   //authenticate 
   public function authenticate(){
       //
       $sql = "SELECT id, name, email FROM users WHERE email = :email AND password = :password";
       $stmt =  $this->db->prepare($sql);
       $stmt->bindValue(':email', $this->__get('email'));
       $stmt->bindValue(':password', $this->__get('password'));
       $stmt->execute();

       $user = $stmt->fetch(\PDO::FETCH_ASSOC);

       if($user['id'] != '' && $user['name'] != ''){
           $this->__set('id', $user['id']);
           $this->__set('name', $user['name']);
           
       }
    
    return $this;
   }

   public function getProfileImage(){
    $sql = "SELECT image FROM users WHERE id = :id";
    $stmt =  $this->db->prepare($sql);
    $stmt->bindValue(':id', $this->__get('id'));
    $stmt->execute();

    return $stmt->fetch(\PDO::FETCH_ASSOC);
   }

   public function getAll(){
       $sql = "SELECT u.id, u.name, u.email, u.image,
                (
                    SELECT 
                        count(*)
                    FROM 
                        user_followers as uf 
                    WHERE uf.id_user = :id_user AND uf.id_user_following = u.id
                ) as following
                FROM users as u
                WHERE u.name like :name AND u.id != :id_user";

       $stmt = $this->db->prepare($sql);
       $stmt->bindValue(':name', '%' . $this->__get('name') . '%'); 
       $stmt->bindValue(':id_user', $this->__get('id')); 
       $stmt->execute();

       return $stmt->fetchAll(\PDO::FETCH_ASSOC);
   }

   public function followUser($id_user_following){
       $sql = "INSERT INTO user_followers (id_user, id_user_following) 
               VALUES (:id_user, :id_user_following)";

       $stmt = $this->db->prepare($sql);
       $stmt->bindValue(':id_user', $this->__get('id'));
       $stmt->bindValue(':id_user_following',$id_user_following);
       $stmt->execute();

       return true;

   }

   public function unfollowUser($id_user_following){
    $sql = "DELETE FROM user_followers
            WHERE id_user = :id_user AND id_user_following = :id_user_following";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id_user', $this->__get('id'));
    $stmt->bindValue(':id_user_following',$id_user_following);
    $stmt->execute();

    return true;
   }

   public function getUserFollowed($id_user){
       $sql = "SELECT count(*) as follow FROM user_followers where id_user = :id_user and id_user_following = :id_user_following ;";
       $stmt = $this->db->prepare($sql);
       $stmt->bindValue(':id_user',$id_user);
       $stmt->bindValue(':id_user_following', $this->__get('id'));
       $stmt->execute();
   
       return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

   public function getInfoUser(){
       $sql = "SELECT name FROM users WHERE id = :id_user";
       $stmt= $this->db->prepare($sql);
       $stmt->bindValue(':id_user', $this->__get('id'));
       $stmt->execute();

       return $stmt->fetch(\PDO::FETCH_ASSOC);
   }

   public function getTotalTweets(){
        $sql = "SELECT count(*) as total_tweets FROM tweets WHERE id_user = :id_user";
        $stmt= $this->db->prepare($sql);
        $stmt->bindValue(':id_user', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function getTotalFollowing(){
        $sql = "SELECT count(*) as total_following FROM user_followers WHERE id_user = :id_user";
        $stmt= $this->db->prepare($sql);
        $stmt->bindValue(':id_user', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getTotalFollowers(){
        $sql = "SELECT count(*) as total_followers FROM user_followers WHERE id_user_following = :id_user";
        $stmt= $this->db->prepare($sql);
        $stmt->bindValue(':id_user', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getProfileLocation(){
        $sql = "SELECT location FROM users  WHERE id = :id_user";
        $stmt= $this->db->prepare($sql);
        $stmt->bindValue(':id_user', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    } 

    public function getProfileAniversary(){
        $sql = "SET lc_time_names = 'pt_BR';";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();


        $sql = "SELECT 
                    aniversary,
                    monthname(aniversary) as month, 
                    DAYOFWEEK(aniversary) as day, 
                    YEAR(aniversary) as year
                from users WHERE id = :id_user";
        $stmt= $this->db->prepare($sql);
        $stmt->bindValue(':id_user', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    } 

    public function getProfileBio(){
        $sql = "SELECT bio FROM users  WHERE id = :id_user";
        $stmt= $this->db->prepare($sql);
        $stmt->bindValue(':id_user', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    } 

}