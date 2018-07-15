<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;

class LogController extends Controller
{
	public function __construct(){
		$this->middleware('auth:admin');
	}

    public function show($id){
    	$mahasiswa = Mahasiswa::with('logs')->findOrFail($id);
    	return view('admin.log', compact('mahasiswa'));
    }
}
