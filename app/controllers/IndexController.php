<?php

namespace App\Controllers;

use App\Views\IndexView;
use Zend\Diactoros\ServerRequest;

class IndexController
{
    public function index(ServerRequest $request, array $pathParams = [])
    {
        IndexView::show();
    }
}
