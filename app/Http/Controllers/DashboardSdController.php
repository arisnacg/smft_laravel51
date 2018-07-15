<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use PDF;
use Response;
use Validator;
use App\Mahasiswa;
use App\Angkatan;
use App\ProgramStudi;
use App\GolonganDarah;
use App\JenisKelamin;
use App\Agama;
use App\PengumumanStudentDay;

class DashboardSdController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:mahasiswa');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }
        $data = DB::table('pengumuman_student_days')
            ->orderBy('id', 'desc')
            ->simplePaginate(3);
        // return $data;
        return view('sd.beranda', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function biodata()
    {
        if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }
   
        $data = DB::table('mahasiswas')
                ->leftjoin('angkatans', 'mahasiswas.angkatan', '=', 'angkatans.id')
                ->leftjoin('golongan_darahs', 'mahasiswas.gol_darah', '=', 'golongan_darahs.id')
                ->leftJoin('jenis_kelamins', 'mahasiswas.jenis_kelamin', '=', 'jenis_kelamins.id')
                ->leftjoin('program_studis', 'mahasiswas.program_studi', '=', 'program_studis.id')
                ->leftjoin('agamas', 'mahasiswas.agama', '=', 'agamas.id')
                ->select('mahasiswas.*', 'angkatans.tahun as tahun', 'golongan_darahs.nama as goldar', 'jenis_kelamins.nama as jk', 
                        'program_studis.nama as prodi', 'agamas.nama as agama_')
                ->where('mahasiswas.id', '=', Auth::user()->id)
                ->first();
        // return Response::json($data);
        return view('sd.biodata', compact('data', 'organisasis', 'prestasis'));
    }

    public function cetakBerkas(){
        if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }
        $data = DB::table('mahasiswas')
                ->leftjoin('angkatans', 'mahasiswas.angkatan', '=', 'angkatans.id')
                ->leftjoin('program_studis', 'mahasiswas.program_studi', '=', 'program_studis.id')
                ->leftjoin('agamas', 'mahasiswas.agama', '=', 'agamas.id')
                ->select('mahasiswas.*', 'angkatans.tahun as tahun', 'program_studis.nama as prodi', 'agamas.nama as agama_')
                ->where('mahasiswas.id', '=', Auth::user()->id)
                ->first();
        return view('sd.cetak-berkas', compact('data'));
    }

    public function nameTag()
    {
        if(Auth::user()->lengkap == 0){
            return redirect()->route('beranda-sd.cetak-berkas');
        }
        $data = DB::table('mahasiswas')
                ->leftjoin('angkatans', 'mahasiswas.angkatan', '=', 'angkatans.id')
                ->leftjoin('program_studis', 'mahasiswas.program_studi', '=', 'program_studis.id')
                ->select('mahasiswas.*', 'angkatans.tahun as tahun', 'program_studis.nama as prodi')
                ->where('mahasiswas.id', '=', Auth::user()->id)
                ->first();
        $pdf = PDF::loadView('sd.name-tag-pdf', compact('data'));
        return $pdf->setPaper('a4', 'potrait')->stream();
    }

    public function biodataPdf()
    {
        if(Auth::user()->lengkap == 0){
            return redirect()->route('beranda-sd.cetak-berkas');
        }
        $prestasis = DB::table('prestasis')
                    ->leftJoin('mahasiswas', 'prestasis.mahasiswa_id', '=', 'mahasiswas.id')
                    ->select('prestasis.nama')
                    ->get();
        // return $prestasis;
        
        $organisasis = DB::table('organisasis')
                    ->leftJoin('mahasiswas', 'organisasis.mahasiswa_id', '=', 'mahasiswas.id')
                    ->select('organisasis.nama')
                    ->get();
        // return $organisasis;

        $data = DB::table('mahasiswas')
                ->leftjoin('angkatans', 'mahasiswas.angkatan', '=', 'angkatans.id')
                ->leftjoin('program_studis', 'mahasiswas.program_studi', '=', 'program_studis.id')
                ->leftjoin('golongan_darahs', 'mahasiswas.gol_darah', '=', 'golongan_darahs.id')
                ->leftjoin('agamas', 'mahasiswas.agama', '=', 'agamas.id')
                ->leftjoin('organisasis', 'mahasiswas.id', '=', 'organisasis.mahasiswa_id')
                ->leftjoin('prestasis', 'mahasiswas.id', '=', 'prestasis.mahasiswa_id')
                ->select('mahasiswas.*', 'angkatans.tahun as tahun', 'program_studis.nama as prodi', 
                        'golongan_darahs.nama as goldar', 'agamas.nama as agama_')
                ->where('mahasiswas.id', '=', Auth::user()->id)
                ->first(); 
        // return Response::json($data);       
        $pdf = PDF::loadView('sd.biodata-pdf', compact('data', 'prestasis', 'organisasis'));
        return $pdf->setPaper('a4', 'potrait')->stream();
    }

    public function evaluasiPdf(){
        if(Auth::user()->lengkap == 0){
            return redirect()->route('beranda-sd.cetak-berkas');
        }
        $data = DB::table('mahasiswas')
                ->join('program_studis', 'mahasiswas.program_studi', '=', 'program_studis.id')
                ->select('mahasiswas.*', 'program_studis.nama as prodi')
                ->where('mahasiswas.id', '=', Auth::user()->id)
                ->first();
        $pdf = PDF::loadView('sd.evaluasi-pdf', compact('data'));
        return $pdf->setPaper('a4', 'potrait')->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }
        $data = Mahasiswa::find(Auth::user()->id);
        $program_studi = ProgramStudi::all();
        $angkatans = Angkatan::all();
        $gol_darahs = GolonganDarah::all();
        $jenis_kelamins = JenisKelamin::all();
        $agamas = Agama::all();
        return view('sd.edit-biodata', compact('data', 'program_studi', 'angkatans', 'gol_darahs', 'jenis_kelamins', 'agamas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->ganti_pass == 0){
            return redirect('/ganti-password')->with('info', 'Password harus diganti terlebih dahulu');
        }

        $validator = Validator::make($request->all(), 
            [
                'nama' => 'required',
                'nama_panggilan' => 'required',
                'program_studi' => 'required',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'gol_darah' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'alamat_sekarang' => 'required',
                'no_telepon' => 'required',
                'no_hp' => 'required',
                'email' => 'required|email',
                'asal_sekolah' => 'required',
                'alasan_kuliah' => 'required',
                'hobi' => 'required',
                'cita_cita' => 'required',
                'idola' => 'required',
                'moto' => 'required',
                'jumlah_saudara' => 'required',
                'nama_ayah' => 'required',
                'nama_ibu' => 'required',
                'vegetarian' => 'required',
                'penyakit_khusus' => 'required',
                'mahasiswa_baru' => 'required',
                'angkatan' => 'required',
            ]
        );

        if ($validator->fails()) {
            Session::flash('error', 'Biodata gagal diperbaharui');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nama = $request->nama;
        $mahasiswa->nama_panggilan = $request->nama_panggilan;
        $mahasiswa->program_studi = $request->program_studi;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->agama = $request->agama;
        $mahasiswa->gol_darah = $request->gol_darah;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->alamat_sekarang = $request->alamat_sekarang;
        $mahasiswa->no_telepon = $request->no_telepon;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->email = $request->email;
        $mahasiswa->asal_sekolah = $request->asal_sekolah;
        $mahasiswa->alasan_kuliah = $request->alasan_kuliah;
        $mahasiswa->hobi = $request->hobi;
        $mahasiswa->cita_cita = $request->cita_cita;
        $mahasiswa->idola = $request->idola;
        $mahasiswa->moto = $request->moto;
        $mahasiswa->jumlah_saudara = $request->jumlah_saudara;
        $mahasiswa->nama_ayah = $request->nama_ayah;
        $mahasiswa->nama_ibu = $request->nama_ibu;
        $mahasiswa->vegetarian = $request->vegetarian;
        $mahasiswa->penyakit_khusus = $request->penyakit_khusus;
        $mahasiswa->mahasiswa_baru = $request->mahasiswa_baru;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->lengkap = 1;
        $mahasiswa->save();
        
        Session::flash('success', 'Biodata berhasil diperbaharui');
        return redirect()->route('beranda-sd.biodata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
