<?php

namespace App\Controllers;

use App\Layout\Layout;
use App\Store\Database;


abstract class BaseController {
    protected $db;
    protected $layout;

    public function __construct(Database $db, Layout $layout) {

        $this->db = $db;
        $this->layout = $layout;
    }
}