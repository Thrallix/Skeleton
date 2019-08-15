<?php

/**
 * Class config
 */

class Config {

    public static function fetchConfig() {

        return [
            'project_name'      => 'Project',
            'project_build'     => '1.0',

            'api_keys'          => ['test_key', 'dat123'],

            'project_url'       => 'http://localhost/project',
            'cdn_url'           => 'http://localhost/project/assets',

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