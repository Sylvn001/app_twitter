<?php 

namespace App\Models;

use MF\Model\Model;

class Tweet extends Model{
  
   private $id;
   private $id_user;
   private $tweet;
   private $data;
   private $image;

   public function __get($attr){
       return $this->$attr;
    }

    public function __set($attr, $value){
        $this->$attr = $value;
    }

    public function save(){
        $sql = "INSERT  INTO tweets (tweet, id_user, image) VALUES (:tweet, :id_user, :image)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':tweet', $this->__get('tweet'));
        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->bindValue(':image', $this->__get('image'));
        $stmt->execute();

    }

    public function getAll(){
        $sql = "SELECT 
                    t.id,
                    t.id_user, 
                    u.name, 
                    t.tweet, 
                    t.image,
                    u.image as image_users,
                    DATE_FORMAT(t.data, '%d/%m/%y %H: %i') as data 
                FROM 
                    tweets AS t 
                    LEFT JOIN users as u on (t.id_user = u.id)  
                WHERE 
                    id_user = :id_user
                    OR t.id_user in (SELECT id_user_following FROM user_followers WHERE id_user = :id_user)
                ORDER BY 
                    t.data desc";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPaginate($limit, $offset){
        $sql = "SELECT 
                    t.id,
                    t.id_user, 
                    u.name, 
                    t.tweet, 
                    t.image,
                    u.image as image_users,
                    DATE_FORMAT(t.data, '%d/%m/%y %H: %i') as data 
                FROM 
                    tweets AS t 
                    LEFT JOIN users as u on (t.id_user = u.id)  
                WHERE 
                    id_user = :id_user
                    OR t.id_user in (SELECT id_user_following FROM user_followers WHERE id_user = :id_user)
                ORDER BY 
                    t.data desc
                LIMIT
                    $limit 
                OFFSET
                    $offset";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTotalTweets(){
        $sql = "SELECT 
                    count(*) as total                                                                                                                                                                      
                FROM 
                    tweets AS t 
                    LEFT JOIN users as u on (t.id_user = u.id)  
                WHERE 
                    id_user = :id_user
                    OR t.id_user in (SELECT id_user_following FROM user_followers WHERE id_user = :id_user)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getUserAll(){
        $sql = "SELECT 
                    t.id,
                    t.id_user, 
                    u.name, 
                    t.tweet, 
                    t.image,
                    DATE_FORMAT(t.data, '%d/%m/%y %H: %i') as data 
                FROM 
                    tweets AS t 
                    LEFT JOIN users as u on (t.id_user = u.id)  
                WHERE 
                    id_user = :id_user
                ORDER BY 
                    t.data desc";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTweetImage(){
        $sql = "SELECT image FROM tweets WHERE id = :id AND id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC)['image'];

    }

    public function destroy(){
        $sql = "DELETE from tweets where id = :id  AND id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->execute();

        return true;
    }



}