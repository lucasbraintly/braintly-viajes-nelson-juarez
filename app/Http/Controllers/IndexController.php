<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $airports = Airport::orderBy('location')->get();

        return view('index', compact('airports'));
    }
}
