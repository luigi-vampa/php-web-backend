<?php

require_once P_MODELS . 'specific_controller.php';
require_once P_MODELS . 'simple_controller.php';
require_once P_MODELS . 'user.php';


abstract class AuthController extends SimpleController implements SpecificController {

    private $acces_level = UserLvl::EVERYONE;
    private $error_template = '403.html';

    private function __construct() {
        if (!AUTH) {
            die('Authentification turned off');
        }
    }

    protected function register_user_acces(int $acces_lvl) {
        $this->acces_level = $acces_lvl;
    }

    protected function register_error_template(string $t) {
        $this->error_template = $t;
    }

    public function render() {

        // Backend::echo_debug($this->acces_level);

        if($_SESSION['user']->acces < $this->acces_level) {
            $this->register_template($this->error_template);
        }

        parent::render();
    }

    public function execute() {

        if($_SESSION['user']->acces < $this->acces_level) {
            $this->render();
            return;
        }

        parent::execute();
    }
}
