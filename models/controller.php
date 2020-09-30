<?php

require_once P_MODELS . 'specific_controller.php';
require_once P_UTILS . 'controller_factory.php';

class Controller {

    const DEFAULT_ERR_CONTROLLER = 'error';
    const DEFAULT_ERR_ACTION = 'render';
  
    private $controller = "";
    private $action = "";
    // PHP 7.3
    private $specific_controller = null;
    // PHP 7.4
    // private SpecificController $specific_controller = null;

    public function __construct(string $controller, string $action)
  {
    $this->controller = $controller;
    $this->action = $action;

    $this->load_specific_controller();
  }

  private function load_specific_controller() {
    $this->specific_controller = ControllerFactory::load_controller($this->controller, self::DEFAULT_ERR_CONTROLLER);
  }

  public function execute() {
    try {
      $this->specific_controller->{ $this->action }();
    } catch (Error $e) {
      $this->specific_controller->{ self::DEFAULT_ERR_ACTION }();
    }
  }
}