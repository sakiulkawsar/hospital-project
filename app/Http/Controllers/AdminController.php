<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addDoctors(){
        return view('admin.add_doctors');
    }
}
