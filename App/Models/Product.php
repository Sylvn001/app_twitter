<?php 

namespace App\Models;

use MF\Model\Model;

class Product extends Model{
  
    public function getProducts(){
        $sql = "SELECT id, description, price FROM tb_products";
        return $this->db->query($sql)->fetchAll();
    }

}