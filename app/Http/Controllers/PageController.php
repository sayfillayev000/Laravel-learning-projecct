<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function main()
    {
        // session('session', false);
        // session('session', false);
        // dd(session()->all());
        return view('main');
    }
    public function about()
    {
        return view('about');
    }
    public function services()
    {
        return view('services');
    }
    public function projects()
    {
        return view('projects');
    }
    public function contact()
    {
        return view('contact');
    }
}
