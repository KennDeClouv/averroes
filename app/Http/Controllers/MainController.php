<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $role = Auth::user()->Role->code;
        return redirect()->route("$role.home");
    }
}
