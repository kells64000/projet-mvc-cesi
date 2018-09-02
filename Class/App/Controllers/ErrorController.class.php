<?php
/**
 * Created by PhpStorm.
 * User: kells
 * Date: 02/09/2018
 * Time: 14:52
 */

namespace App\Controllers;


class ErrorController extends BaseController
{
    public function render404() {

        echo $this->layout->render('error');
    }
}