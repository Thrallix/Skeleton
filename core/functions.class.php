<?php

/**
 * Class Func
 * @author Thrallix
 */
class Functions {

    /**
     * @param $input
     * @param $pw
     * @return bool
     */
    public static function verifyPassword($input, $pw) {
        return password_verify($input, $pw);
    }

    /**
     * @param $pw
     * @return bool|string
     */
    public static function securePassword($pw) {
        return password_hash($pw, PASSWORD_BCRYPT, config['hash_options']);
    }

    /**
     * @return mixed
     */
    public static function getIP() {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) { //CloudFlare?
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Prints value with pre
     * @param $var
     * @return string
     */
    public static function print($var) {
        return '<pre>'.print_r($var).'</pre>';
    }

    /**
     * Var_dumps value with pre
     * @param $var
     * @return string
     */
    public static function dump($var) {
        return '<pre>'.var_dump($var).'</pre>';
    }

    /**
     * Fetches parameters from URL
     * @return array
     */
    public static function fetchParams() {

        $params = explode('/', !empty($_GET['params']) ? $_GET['params'] : config['module_default']);

        return !empty($params) ? $params : [];

    }

    /**
     * Creates module page from URL params
     * @return mixed
     */
    public static function getModule() {

        return !empty(params[0]) ? params[0] : config['module_default'];

    }

    /**
     * Creates module action from URL params
     * @return mixed
     */
    public static function getModuleAction() {

        return !empty(params[1]) ? params[1] : 'default';

    }

}