<?php

/**
 * Class config
 */

class Config {

    public static function fetchConfig() {

        return [
            'project_name'      => 'Skeleton',
            'project_build'     => '1.0',

            'api_keys'          => [],

            'project_url'       => 'http://localhost/skeleton',
            'cdn_url'           => 'http://localhost/skeleton/assets',

            'module_directory'  => 'modules',
            'module_files'      => ['ajax.class.php', 'controller.class.php', 'model.class.php'],
            'module_default'    => 'home',

            'modules'           => [
                '404' => 'not_found'
            ],

            'mysql'             => [
                'host' => 'localhost',
                'user' => 'root',
                'pass' => '',
                'datb' => 'project',
                'port' => 3306
            ]
        ];

    }

}