<?php
namespace COMP3385;

abstract class AbstractTemplateEngine {
    protected $variables = [];

    public function assign($key, $value) {
        $this->variables[$key] = $value;
    }
 
    public function render($templateFile) {
        extract($this->variables);
        ob_start();
        include(TPL_DIR.'\\'.$templateFile);
        return ob_get_clean();
    }

    abstract public function generateTemplate($config, $formContent, $header, $formErrors);
}

