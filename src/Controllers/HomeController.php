<?php

namespace App\Controllers;

use PhilLackey\Framework\Http\Response;

class HomeController
{
    public function index(): Response
    {
        $content = '<h2>Wussup??</h2>';

        return new Response($content);
    }
}