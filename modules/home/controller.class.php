<?php

class Controller {

    public static function initialize() {

        switch(action) {

            default:
                $view = 'homepage';
                break;

        }

        Loader::loadTemplate('head');
        Loader::loadTemplate('navbar');
        require 'views/'.(!empty($view) ? $view : '').'.php';
        Loader::loadTemplate('footer');

    }

}