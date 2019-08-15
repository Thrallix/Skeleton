<?php

//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Autoload core files
require 'core/autoload.php';

//Initialize loader
define('config', Config::fetchConfig());
define('params', Functions::fetchParams());
define('module', Functions::getModule());
define('action', Functions::getModuleAction());
define('home', config['project_url']);
define('cdn', config['cdn_url']);
define('name', config['project_name']);

//Set resources
//Loader::setResource('Config', config['cdn_url'] . '/css/config.scss', 'head', 'css');
Loader::setResource('FontAwesome', 'https://use.fontawesome.com/releases/v5.8.2/css/all.css', 'head', 'css');
Loader::setResource('Main', cdn . '/resources/dist/main.css', 'head', 'css');

Loader::setResource('jQuery',  'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js', 'footer', 'js');
Loader::setResource('Popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js', 'footer', 'js');
Loader::setResource('Bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js', 'footer', 'js');
Loader::setResource('Main', cdn . '/resources/dist/main.js', 'footer', 'js');

Loader::initialize();   //Initialize page