<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function show($section) {
        return view('about-us', ['section' => $section]);
    }


}
