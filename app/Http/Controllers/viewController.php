<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewController extends Controller
{
    public function pageHome(){
      return view('home');
    }
    public function pageprojectInfo(){
      return view('projectinfo');
    }
}