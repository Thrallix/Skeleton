<?php

class Ajax {

    public static $result = [
        'result' => false,
        'message' => 'Default form response.',
        'data' => []
    ];

    public static function setResult($state, $message, $data = []) {
        self::$result['result'] = $state;
        self::$result['message'] = $message;
        self::$result['data'] = $data;
        return true;
    }

    public static function getResult() {
        return self::$result;
    }

}