<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        parse_str(base64_decode($request->id), $data);
        return View('home.index', [
            "data" => $data,
            "categorias" => Categories::all()
        ]);
    }

    public function success()
    {
        return View('home.success', []);
    }
}
