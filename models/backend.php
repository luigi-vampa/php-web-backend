<?php

abstract class Backend {
    // Default ones
    static private $action = 'render';
    static private $controller = 'default';
    static private $controller_obj;

    // Helper functions
    static public function redirect(string $redirect_to) {
        header('Location: '.$location);
        DataBase::destroyInstance();
        die();
    }

    static public function echo_debug(string $str) {
        if (DEBUG) {
            die("[DEBUG]: $str");
        }
    }

    static public function dump_debug($var) {
        if (DEBUG) {
            die("[DEBUG]: ".var_dump($var));
        }
    }

    // Main entry point
    static public function main() {

        // Check for controller and action
        if (InputUtils::validateGET(['p'])) {
            self::$controller = InputUtils::get_input_str('p', INPUT_GET);
            // self::echo_debug(InputUtils::get_input_str('p', INPUT_GET));
        }

        if (InputUtils::validateGET(['a'])) {
            self::$action = InputUtils::get_input_str('a', INPUT_GET);
        }

        // self::dump_debug($_SESSION);

        // Create the controller and execute it
        self::$controller_obj = new Controller(self::$controller, self::$action);
        self::$controller_obj->execute();

        // Make sure database is closed before exit
        Database::destroyInstance();
    }
}