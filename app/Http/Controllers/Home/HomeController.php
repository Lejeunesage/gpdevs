<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $user = $request->user();
        // dd($user);
        $canLogin = Route::has('login');
        $canRegister = Route::has('register');

        return Inertia::render('Home', [
            'canLogin' => $canLogin,
            'canRegister' => $canRegister,
        ]);
    }   
}
