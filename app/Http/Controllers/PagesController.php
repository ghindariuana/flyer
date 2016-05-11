<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $flyers = \App\Flyer::all();
        #die(print_r($flyers->toArray()));
        return view('pages.home')->with(compact('flyers'));
    }
}
