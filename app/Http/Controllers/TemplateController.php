<?php

namespace App\Http\Controllers;



class TemplateController extends Controller
{
    public function checkTemplate()
    {
        return theme_view('welcome');

    }
}