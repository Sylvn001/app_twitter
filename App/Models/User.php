<?php 

namespace App\Models;

use MF\Model\Model;

class User extends Model{
  
   private $Id;
   private $name;
   private $email;
   private $password;

   public function __get($attr){
       return $this->$attr;
   }

   public function __set($attr, $value){
       $this->$attr = $value;
   }

   //save
   public function save(){
       $sql = "INSERT INTO users (name, email, password) values (:name , :email, :password)";
       $stmt = $this->db->prepare($sql);
       $stmt->bindValue(':name' , $this->__get('name'));
       $stmt->bindValue(':email', $this->__get('email'));
       $stmt->bindValue(':password', $this->__get('password'));
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

   public function getUserByEmail(){
       $sql = "SELECT name, email from users where email = :email";
       $stmt =  $this->db->prepare($sql);
       $stmt->bindValue('email', $this->__get('email'));
       $stmt->execute();

       return $stmt->fetchAll(\PDO::FETCH_ASSOC);
   }


   //recovery user and email                    

}