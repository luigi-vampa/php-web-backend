<?php

require_once P_MODELS . 'specific_controller.php';

abstract class SimpleController implements SpecificController {

    private $template = 'no_template.html';
    private $func_render = 'default_render';
    private $param_template = [];
    private $func_exec = 'default_execution';
    private $redirect = '/';

    private function default_render()
    {
        global $twig;
        echo $twig->render($this->template, $this->param_template);
    }

    protected function plain_page() {
        $this->func_exec = $this->func_render;
    }

    public function render()
    {
        $this->{ $this->func_render }();
    }

    protected function register_param_template(array $params)
    {
        foreach ($params as $key => $value) {
            $this->param_template[$key] = $value;
        }
    }

    protected function register_func_render(string $func_render)
    {
        $this->func_render = $func_render;
    }

    protected function register_template(string $template)
    {
        $this->template = $template;
    }

    public function execute()
    {
        $this->{ $this->func_exec }();
        header($this->redirect);
    }

    protected function register_func_executable(string $f)
    {
        $this->func_exec = $f;
    }

    protected function register_redirect(string $redirect)
    {
        $this->redirect = $redirect;
    }

    private function default_execution()
    {
        die('No specified process to execute. Create a function and pass it to register_func_executable');
    }
}