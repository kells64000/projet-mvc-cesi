<?php

namespace App\Layout;

class LayoutException extends \Exception {};

class Layout {
    private $name;

    public function __construct($name) {
        $this->setName($name);
    }

    public function setName($name) : Layout {
        $this->path = 'Views/Layouts/' . $name . '.view.php';
        if (!file_exists($this->path)) {
            throw new LayoutException('Layout missing');
        }
        return $this;
    }

    public function render($name, $params = []): string {
        $view = 'Views/' . $name . '.view.php';
        extract($params);
        ob_start();
        require_once $view;
        $content = ob_get_clean();
        ob_start();
        require_once $this->path;
        return ob_get_clean();
    }
}