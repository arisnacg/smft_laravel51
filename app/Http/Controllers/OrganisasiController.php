<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Organisasi;
use App\Log;

class OrganisasiController extends Controller
{
    public function __construct(){
		$this->middleware('auth:admin', [
			'only' => ['show']
		]);
		$this->middleware('auth:mahasiswa', [
			'only' => ['index', 'store', 'destroy']
		]);
	}

	public function index(Request $req){
		$mahasiswa = Mahasiswa::with('organisasi')->findOrFail($req->user()->id);
		return view('sd.organisasi', compact('mahasiswa'));
	}

	public function store(Request $req){
		$this->validate($req, [
			'nama' => 'required|string',
	    	'jabatan' => 'required|string',
	    	'tahun' => 'required|integer'
		]);

		Organisasi::create([
			'mahasiswa_id' => $req->user()->id,
			'nama' => $req->nama,
	    	'jabatan' => $req->jabatan,
	    	'tahun' => $req->tahun
		]);

		Log::create([
			'mahasiswa_id' => $req->user()->id,
			'tipe' => 6,
			'konten' => 'Menambah pengalaman organisasi: '.$req->nama
		]);



		return redirect()->back()->with('success', 'Organisasi berhasil ditambah');
	}

	public function destroy(Request $req, $id){
		$row = Organisasi::findOrFail($id);
		Log::create([
			'mahasiswa_id' => $req->user()->id,
			'tipe' => 7,
			'konten' => 'Menghapus pengalaman organisasi: '.$row->nama
		]);
		$row->delete();
		return redirect()->back()->with('success', 'Organisasi berhasil dihapus');
	}

	public function show($id){
    	$mahasiswa = Mahasiswa::with('organisasi')->findOrFail($id);
    	return view('admin.organisasi', compact('mahasiswa'));
    }
}
