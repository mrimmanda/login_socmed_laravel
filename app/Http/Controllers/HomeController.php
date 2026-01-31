<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataUser;

class HomeController extends Controller
{
    public function index()
    {
        $query = DataUser::query();

        if (!Auth::user() !== 1) {
            $query->where('owner', Auth::id());
        }

        $data = $query->latest()->get();

        return view('home.index', compact('data'));
    }
}
