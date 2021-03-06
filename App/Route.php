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

        $routes['timeline'] = array(
            'route' => '/timeline',
            'controller' => 'AppController',
            'action' => 'timeline'
        );

        $routes['loggout'] = array(
            'route' => '/loggout',
            'controller' => 'AuthController',
            'action' => 'loggout'
        );

        $routes['tweet'] = array(
            'route' => '/tweet',
            'controller' => 'AppController',
            'action' => 'tweet'
        );

        $routes['delete'] = array(
            'route' => '/delete',
            'controller' => 'AppController',
            'action' => 'deletePost'
        );

        $routes['profile'] = array(
            'route' => "/profile",
            'controller' => 'AppController',
            'action' => 'profile'
        );

        $routes['who_to_follow'] = array(
            'route' => '/who_to_follow',
            'controller' => 'AppController',
            'action' => 'whoToFollow'
        );

        $routes['action'] = array(
            'route' => '/action',
            'controller' => 'AppController',
            'action' => 'action'
        );

        $routes['editProfile'] = array(
            'route' => '/editProfile',
            'controller' => 'AppController',
            'action' => 'update'
        );

        $this->setRoutes($routes);
    }

}