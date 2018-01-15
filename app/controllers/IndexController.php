<?php

namespace App\Controllers;

use App\Views\IndexView;

class IndexController
{
    public function index()
    {
        IndexView::show();
    }
}
