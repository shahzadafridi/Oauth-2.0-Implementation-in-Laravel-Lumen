<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){

        $data = 'Response result show here...';
        
        return view('pages.home')->with("data",$data);
    }
}