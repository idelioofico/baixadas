<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class DashboardController extends Controller
{

    
    public function __construct()
    { 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (Auth::user()->mobile_access == 1) {
            
            return redirect()->route('guiasaidaproduto.create', ['id' => 0]);
        }

        return redirect()->route('guiasaida.index');
           
 
        return view('index', $data);
    }

 
}
