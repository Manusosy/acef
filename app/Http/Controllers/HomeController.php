<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function programmes()
    {
        return view('programmes');
    }

    public function projects()
    {
        return view('projects');
    }

    public function impact()
    {
        return view('impact');
    }

    public function resources()
    {
        return view('resources');
    }

    public function news()
    {
        return view('news');
    }

    public function contact()
    {
        return view('contact');
    }

    public function donate()
    {
        return view('donate');
    }

    public function getInvolved()
    {
        return view('get-involved');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('terms');
    }

    public function gallery()
    {
        return view('gallery');
    }

    public function team()
    {
        return view('team');
    }

    public function partners()
    {
        return view('partners');
    }

    public function accreditations()
    {
        return view('accreditations');
    }
    public function cookies()
    {
        return view('cookies');
    }
}
