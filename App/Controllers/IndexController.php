<?php 

namespace App\Controllers;

use MF\Model\Container;
use MF\Controller\Action;

//Models
use App\Models\Product;
use App\Models\Info;


class IndexController extends Action{

    public function index(){

        $product = Container::getModel('Product');
        
        $products = $product->getProducts(); //return array of Products in method.
        

        $this->render('index', 'layout');
    }

    public function subscribe(){

        $this->render('subscribe', 'layout');
    }


}                       