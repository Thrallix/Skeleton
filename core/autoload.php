<?php
spl_autoload_register(function ($class_name) {
    require $class_name.'.class.php';
});