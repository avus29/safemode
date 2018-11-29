<?php

namespace GistMed\Http\Controllers;

use Illuminate\Http\Request;
use GistMed\Http\Middleware\IsAdmin;

class OgaController extends Controller
{
    //
    public function __construct(){
        $this->middleware(['auth:expert','is_admin']);
    }
    
    public function index(){
        return view('admin');
    }
}
