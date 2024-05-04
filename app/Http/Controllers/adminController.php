<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function showDashboard()
    {
        $data = Berita::latest()->get();
        return view('welcome', compact('data'));
    }
}
