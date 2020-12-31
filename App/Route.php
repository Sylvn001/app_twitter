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

        $routes['register'] = array(
            'route' => '/register',
            'controller' => 'indexController',
            'action' => 'register'
        );

        $routes['login'] = array(
            'route' => '/login',
            'controller' => 'AuthController',
            'action' => 'auth'
        );

        $this->setRoutes($routes);
    }

}