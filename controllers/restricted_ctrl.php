<?php

require_once P_MODELS . 'auth_controller.php';
require_once P_MODELS . 'specific_controller.php';
require_once P_MODELS . 'user.php';


class restrictedController extends AuthController implements SpecificController {


    public function __construct() {
        // Backend::echo_debug('Enters restricted controller');
        $this->register_template('restricted.html');
        $this->register_user_acces(UserLvl::EVERYONE);
    }

}