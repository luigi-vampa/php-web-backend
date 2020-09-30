<?php
require_once P_MODELS . 'simple_controller.php';
require_once P_MODELS . 'specific_controller.php';


class defaultController extends SimpleController implements SpecificController
{
    public function __construct()
    {
        $this->plain_page();
        $this->register_template('default.html');
    }
}