<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConsumeController extends Controller
{
    public function index(){
        $usuarios = HTTP::get("http://prueba.test/api/products");
        $usuariosArray = json_decode($usuarios);
        return view('welcome', compact('usuariosArray'));
    }

    public function InsertProduct()
    {
        $Product = HTTP::post("http://prueba.test/api/InsertProduct?description=&id_category=");
        return view('welcome');
    }
}
