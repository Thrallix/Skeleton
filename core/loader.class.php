<?php

/**
 * Class autoloader
 */

class Loader {

    public static $module_directory = 'modules';
    public static $template_directory = 'templates';
    public static $module_files = ['controller.class.php', 'ajax.class.php', 'model.class.php'];
    public static $resources = [];

    /**
     * Load module properly, if file missing return 404
     */
    public static function initialize() {

        if (file_exists(self::$module_directory)) {

            foreach(self::$module_files as $requirement) {

                $req_path = self::$module_directory . '/'.module.'/' . $requirement;

                if (file_exists($req_path)) {

                    require $req_path;

                } else {
                    require config['module_directory'] . '/'.config['module_default'].'/' . $requirement;
                }

            }

        }

        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            Controller::initialize();
        } else {
            AjaxController::initialize();
        }

    }

    /**
     * Resources
     */
    public static function setResource($id, $source, $location, $type) {
        self::$resources[$location][] = [
            'id' => $id,
            'source' => $source,
            'type' => $type
        ];
    }
    public static function getResources($location, $type) {

        $output = '';

        foreach(self::$resources[$location] as $resource) {
            if ($resource['type'] == $type) {
                switch ($type) {
                    case 'js':
                        $output = $output . '<script src="' . $resource['source'] . '"></script>';
                        break;
                    case 'css':
                    case 'scss':
                        $output = $output . '<link href="' . $resource['source'] . '" rel="stylesheet" />';
                        break;
                }
            }
        }

        return $output;

    }

    public static function loadTemplate($name) {

        if (file_exists(self::$template_directory . "/$name.template.php")) {
            require self::$template_directory . "/$name.template.php";
        } else {
            die('Template not found: ' . $name);
        }

    }

}