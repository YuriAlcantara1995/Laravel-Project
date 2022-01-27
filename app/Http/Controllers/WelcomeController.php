<?php

namespace App\Http\Controllers;

use App\Models\Realtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $realtors = Cache::remember('welcome_realtors', 120 , function () {
            return DB::table('realtors')->get();
        });

        return view('welcome', compact('realtors'));
    }

    public function index(Request $request)
    {
        $realtors = Cache::remember('welcome_realtors', 120 , function () {
            return DB::table('realtors')->get();
        });

        return view('welcome', compact('realtors'));
    }
}
