<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realtor;

class WelcomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $realtors = Realtor::all();

        return view('welcome',compact('realtors'));
    }

    public function index(Request $request)
    {
        $realtors = Realtor::all();

        return view('welcome',compact('realtors'));
    }
}
