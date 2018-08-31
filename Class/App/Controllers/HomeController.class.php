<?php

namespace App\Controllers;

class HomeController extends BaseController {

    public function show() {

        echo $this->layout->render('accueil');
    }
}