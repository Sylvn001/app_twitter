<?php 

namespace App; 

use MF\Init\Bootstrap;

class Route extends Bootstrap {

    public function initRoutes(){
        $routes['home'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index'
        );

        $routes['subscribe'] = array(
            'route' => '/subscribe',
            'controller' => 'indexController',
            'action' => 'subscribe'
        );

        $this->setRoutes($routes);
    }

}