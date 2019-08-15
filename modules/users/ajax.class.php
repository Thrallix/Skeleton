<?php

class AjaxController {

    public static function initialize() {

        switch(action) {
            case 'register':
                Model::registerAccount($_POST);
                break;
        }

        die(json_encode(Ajax::getResult()));

    }

}