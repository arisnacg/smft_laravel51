<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Prestasi;
use App\Log;
use App\Auth;

class PrestasiController extends Controller
{
	public function __construct(){
		$this->middleware('admin', [
			'only' => ['show']
		]);
		$this->middleware('auth:user', [
			'only' => ['index', 'store', 'destroy']
		]);
	}

	public function index(Request $req){
		if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }
		$mahasiswa = User::findOrFail($req->user()->id);
		$prestasi = Prestasi::where('mahasiswa_id', $req->user()->id)->get();
		return view('sd.prestasi', compact('mahasiswa', 'prestasi'));
	}

	public function store(Request $req){
		$this->validate($req, [
			'nama' => 'required|string',
	    	'tingkat' => 'required|string',
	    	'tahun' => 'required|integer'
		]);

		Prestasi::create([
			'mahasiswa_id' => $req->user()->id,
			'nama' => $req->nama,
	    	'tingkat' => $req->tingkat,
	    	'tahun' => $req->tahun
		]);


		Log::create([
			'mahasiswa_id' => $req->user()->id,
			'tipe' => 4,
			'konten' => 'Menambah prestasi : '.$req->nama
		]);


		return redirect()->back()->with('success', 'Prestasi berhasil ditambah');
	}

	public function destroy(Request $req, $id){
		$row = Prestasi::findOrFail($id);
		Log::create([
			'mahasiswa_id' => $req->user()->id,
			'tipe' => 5,
			'konten' => 'Menghapus prestasi : '.$row->nama
		]);
		$row->delete();
		return redirect()->back()->with('success', 'Prestasi berhasil dihapus');
	}

    public function show($id){
    	$mahasiswa = User::findOrFail($id);
		$prestasi = Prestasi::where('mahasiswa_id', $id)->get();
    	return view('admin.prestasi', compact('mahasiswa', 'prestasi'));
    }
}
