<?php 

namespace App\Models;

use MF\Model\Model;

class Tweet extends Model{
  
   private $id;
   private $id_user;
   private $tweet;
   private $data;

   public function __get($attr){
       return $this->$attr;
    }

    public function __set($attr, $value){
        $this->$attr = $value;
    }

    public function save(){
        $sql = "INSERT  INTO tweets (tweet, id_user) VALUES (:tweet, :id_user)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':tweet', $this->__get('tweet'));
        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->execute();

    }

    public function getAll(){
        $sql = "SELECT t.id, t.id_user, u.name, t.tweet, DATE_FORMAT(t.data, '%d/%m/%y %H: %i') 
        as data FROM tweets AS t LEFT JOIN users as u on (t.id_user = u.id)  WHERE id_user = :id
        ORDER BY t.data desc";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $this->__get('id_user'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


}