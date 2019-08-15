<?php

class Controller {

    public static function initialize() {

        switch(action) {

            case 'login':
                $view = 'login';
                break;

            case 'register':
                $view = 'register';
                break;

            default:
                $view = 'register';
                break;

        }

        Loader::loadTemplate('head');
        Loader::loadTemplate('navbar');
        require 'views/'.(!empty($view) ? $view : '').'.php';
        Loader::loadTemplate('footer');

    }

}