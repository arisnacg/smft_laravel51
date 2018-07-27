<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\ProgramStudi;
use App\Angkatan;
use App\PengumumanStudentDay;
use App\GolonganDarah;
use App\JenisKelamin;
use App\Agama;
use DB;
use Hash;
use Session;
use File;
use Image;
use Excel;
use App\Exports\MahasiswaExport;
use Validator;
use Auth;

class AdminController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = User::all()->count();
        // return $mahasiswa;
        $verifikasi = DB::table('users')
                        ->select('users.*', 'logs.*')
                        ->where('users.lengkap', '=', 1)
                        ->count();
        $belum_verifikasi = $mahasiswa - $verifikasi;
                        
        return view('admin.index', compact('mahasiswa', 'verifikasi', 'belum_verifikasi'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaIndex(Request $req)
    {
        $filter = [];
        $data = User::with(['prodi', 'mhsangkatan']);
        // $data = DB::table('users')
        //             ->leftJoin('program_studis', 'users.program_studi', '=', 'program_studis.id')
        //             ->leftJoin('jenis_kelamins', 'users.jenis_kelamin', '=', 'jenis_kelamins.id')
        //             ->leftJoin('golongan_darahs', 'users.gol_darah', '=', 'golongan_darahs.id')
        //             ->leftJoin('angkatans', 'users.angkatan', '=', 'angkatans.id')
        //             ->select('users.*', 'program_studis.nama as prodi', 'jenis_kelamins.nama as jk', 'golongan_darahs.nama as goldar', 'angkatans.tahun as tahun')
        //             ->orderBy('nim', 'asc');
        if($req->has('lengkap')){  
            if($req['lengkap'] == 1 || $req['lengkap'] == 0){
                $data->where('lengkap', $req->lengkap);
                $filter['lengkap'] = $req->lengkap;
            }
        }
        $data = $data->get();
        return view('admin.mahasiswa', compact('data', 'filter'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanIndex()
    {
        $data = DB::table('pengumuman_student_days')->orderBy('id', 'desc')->get();
        return view('admin.sd-pengumuman', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function angkatanIndex()
    {
        $data = Angkatan::all();
        return view('admin.angkatan', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function golonganDarahIndex()
    {
        $data = GolonganDarah::all();
        return view('admin.golongan-darah', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jenisKelaminIndex()
    {
        $data = JenisKelamin::all();
        return view('admin.jenis-kelamin', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function programStudiIndex()
    {
        $data = ProgramStudi::all();
        return view('admin.program-studi', compact('data'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaCreate()
    {
        $program_studi = ProgramStudi::all();
        $angkatans = Angkatan::all();
        $agamas = Agama::all();
        return view('admin.add-mahasiswa', compact('program_studi', 'angkatans', 'agamas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanCreate()
    {
        return view('admin.add-sd-pengumuman');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'nim' => 'required|string|max:10',
                'nama' => 'required|string',
                'program_studi' => 'required',
                'jenis_kelamin' => 'required',
            ]
        );

        if ($validator->fails()) {
            Session::flash('error', 'Mahasiswa gagal ditambahkan');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $mahasiswa = new User;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->password = Hash::make($request->nim);
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
        $mahasiswa->save();
        Session::flash('success', 'Mahasiswa berhasil ditambahkan');
        return redirect()->route('admin.mahasiswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanStore(Request $request)
    {
        $pengumuman = new PengumumanStudentDay;
        $pengumuman->judul = $request->judul;
        $pengumuman->konten = $request->konten;
        if($request->hasFile('gambar')){
    		$thumbnail = $request->file('gambar');
    		$fileName = time() . '.' .$thumbnail->getClientOriginalExtension();
    		Image::make($thumbnail)->save('thumbnail/' . $fileName);
    		$pengumuman->gambar = $fileName;
        }
        $pengumuman->save();
        Session::flash('success', 'Pengumuman berhasil ditambahkan');
        return redirect()->route('admin.sd-pengumuman');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function angkatanStore(Request $request)
    {
        $angkatan = new Angkatan;
        $angkatan->tahun = $request->tahun;
        $angkatan->save();
        Session::flash('success', 'Angkatan berhasil ditambahkan');
        return redirect()->route('admin.angkatan-index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function jenisKelaminStore(Request $request)
    {
        $jenis_kelamin = new JenisKelamin;
        $jenis_kelamin->nama = $request->nama;
        $jenis_kelamin->save();
        Session::flash('success', 'Jenis kelamin berhasil ditambahkan');
        return redirect()->route('admin.jenis-kelamin-index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function programStudiStore(Request $request)
    {
        $prodi = new ProgramStudi;
        $prodi->nama = $request->nama;
        $prodi->save();
        Session::flash('success', 'Program studi berhasil ditambahkan');
        return redirect()->route('admin.program-studi-index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaEdit($id)
    {
        $data = User::find($id);
        $program_studi = ProgramStudi::all();
        $angkatans = Angkatan::all();
        $jenis_kelamins = JenisKelamin::all();
        $agamas = Agama::all();
        $gol_darahs = GolonganDarah::all();
        // return $mahasiswa;
        return view('admin.edit-mahasiswa', compact('data', 'program_studi', 'angkatans', 'jenis_kelamins', 'agamas', 'gol_darahs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanEdit($id)
    {
        $data = PengumumanStudentDay::find($id);
        return view('admin.edit-sd-pengumuman', compact('data'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'nim' => 'required|string|max:10',
                'nama' => 'required|string',
                'program_studi' => 'required',
                'jenis_kelamin' => 'required',
            ]
        );

        if ($validator->fails()) {
            Session::flash('error', 'Mahasiswa gagal diperbaharui');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $mahasiswa = User::find($id);
        $mahasiswa->nim = $request->nim;
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
        $mahasiswa->save();
        Session::flash('success', 'Mahasiswa berhasil diperbaharui');
        return redirect()->route('admin.mahasiswa');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanUpdate(Request $request, $id)
    {
        $pengumuman = PengumumanStudentDay::find($id);
        $pengumuman->judul = $request->judul;
        $pengumuman->konten = $request->konten;
        
        if ($request->hasFile('gambar')) {
            $oldFileName = $pengumuman->gambar;
            File::delete('thumbnail/'. $oldFileName);

            $thumbnail = $request->file('gambar');
    		$fileName = time() . '.' .$thumbnail->getClientOriginalExtension();
    		Image::make($thumbnail)->save('thumbnail/' . $fileName);
    		$pengumuman->gambar = $fileName;
        }

        Session::flash('success', 'Pengumuman berhasil diperbaharui');
        $pengumuman->save();
        return redirect()->route('admin.sd-pengumuman');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function angkatanUpdate(Request $request, $id)
    {
        $angkatan = Angkatan::find($id);
        $angkatan->tahun = $request->tahun;
        $angkatan->save();
        Session::flash('success', 'Angkatan berhasil diperbaharui');
        return redirect()->route('admin.angkatan-index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jenisKelaminUpdate(Request $request, $id)
    {
        $jenis_kelamin = JenisKelamin::find($id);
        $jenis_kelamin->nama = $request->nama;
        $jenis_kelamin->save();
        Session::flash('success', 'Jenis kelamin berhasil diperbaharui');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function programStudiUpdate(Request $request, $id)
    {
        $prodi = ProgramStudi::find($id);
        $prodi->nama = $request->nama;
        $prodi->save();
        Session::flash('success', 'Program studi berhasil diperbaharui');
        return redirect()->route('admin.program-studi-index');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaDestroy($id)
    {
        $mahasiswa = User::find($id);
        $mahasiswa->delete();
        Session::flash('success', 'Mahasiswa berhasil dihapus');
        return redirect()->route('admin.mahasiswa');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sdPengumumanDestroy($id)
    {
        $pengumuman = PengumumanStudentDay::find($id);
        $pengumuman->delete();
        Session::flash('success', 'Pengumuman berhasil dihapus');
        return redirect()->route('admin.sd-pengumuman');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function angkatanDestroy($id)
    {
        $angkatan = Angkatan::find($id);
        $angkatan->delete();
        Session::flash('success', 'Angkatan berhasil dihapus');
        return redirect()->route('admin.angkatan-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jenisKelaminDestroy($id)
    {
        $jenis_kelamin = JenisKelamin::find($id);
        $jenis_kelamin->delete();
        Session::flash('success', 'Jenis kelamin berhasil dihapus');
        return redirect()->route('admin.jenis-kelamin-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function programStudiDestroy($id)
    {
        $prodi = ProgramStudi::find($id);
        $prodi->delete();
        Session::flash('success', 'Program studi berhasil dihapus');
        return redirect()->route('admin.program-studi-index');
    }

    public function excel(){
    //     protected $fillable = [
    //     'nim', 'password', 'nama', 'nama_panggilan', 'program_studi', 'jenis_kelamin', 
    //     'gol_darah', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'alamat_sekarang', 
    //     'no_telepon', 'no_hp', 'email', 'asal_sekolah', 'hobi', 'cita-cita', 'idola', 
    //     'moto', 'jumlah_saudara', 'nama_ayah', 'nama_ibu', 'vegetarian', 'penyakit_khusus', 
    //     'mahasiswa_baru', 'angkatan', 'ganti_pass'
    // ];
        // $data = User::with([
        //     'prodi',
        //     'mhsangkatan',
        //     'goldarah',
        //     'kelamin',
        //     'tb_log' => function($q){
        //         $q->where('tipe', 1)->orderBy('id', 'desc')->first();
        //     }
        // ])->withCount('prestasi', 'organisasi')->get();
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
        // $arr_excel = array(
        //     'No',
        //     'NIM',
        //     'Nama Lengkap',
        //     'Nama Panggilan',
        //     'Program Studi',
        //     'Jenis Kelamin',
        //     'Gol Darah',
        //     'Tempat Lahir',
        //     'Tanggal Lahir',
        //     'Alamat Asal',
        //     'Alamat Sekarang',
        //     'No Telp',
        //     'No HP',
        //     'Email',
        //     'Asal Sekolah',
        //     'Hobi',
        //     'Cita-cita',
        //     'Idola',
        //     'Moto',
        //     'Jumlah Saudara',
        //     'Nama Ayah',
        //     'Nama Ibu',
        //     'Vegetarian',
        //     'Penyakit Khusus',
        //     'Mahasiswa Baru',
        //     'Angkatan',
        //     'Prestasi',
        //     'Pengalaman Organisasi',
        //     'Terakhir Login'
        // );
        // foreach ($data as $i => $row) {
        //     $arr_excel[] = array(
        //         'No' => $i + 1,
        //         'NIM' => $row->nim,
        //         'Nama Lengkap' => $row->nama,
        //         'Nama Panggilan' => $row->nama_panggilan,
        //         'Program Studi' => $row->prodi->nama,
        //         'Jenis Kelamin' => $row->kelamin->nama,
        //         'Gol Darah' => $row->goldarah->nama,
        //         'Tempat Lahir' => $row->tempat_lahir,
        //         'Tanggal Lahir' => $row->tanggal_lahir,
        //         'Alamat Asal' => $row->alamat,
        //         'Alamat Sekarang' => $row->alamat_sekarang,
        //         'No Telp' => $row->no_telepon,
        //         'No HP' => $row->no_hp,
        //         'Email' => $row->email,
        //         'Asal Sekolah' => $row->asal_sekolah,
        //         'Hobi' => $row->hobi,
        //         'Cita-cita' => $row->cita_cita,
        //         'Idola' => $row->idola,
        //         'Moto' => $row->moto,
        //         'Jumlah Saudara' => $row->jumlah_saudara,
        //         'Nama Ayah' => $row->nama_ayah,
        //         'Nama Ibu' => $row->nama_ibu,
        //         'Vegetarian' => ($row->vegetarian == 1)? 'Ya' : 'Tidak',
        //         'Penyakit Khusus' => $row->penyakit_khusus,
        //         'Mahasiswa Baru' => ($row->mahasiswa_baru == 1)? 'Ya' : 'Tidak',
        //         'Angkatan' => $row->mhsangkatan->tahun,
        //         'Prestasi' => $row->prestasi_count,
        //         'Pengalaman Organisasi' => $row->organisasi_count,
        //         'Terakhir Login' => (isset($row->tb_log))? $row->tb_log[0]->created_at->format('d-m-Y') : 'Tidak Ada'
        //     );
        // }
        //
    }

    public function gantiPasswordIndex(){
        return view('admin.password');
    }

    public function gantiPassword(Request $req){
    	$this->validate($req, [
    		//'password' => 'required|string|confirmed',
    		'password_lama' => 'required|string'
    	]);

    	if(Hash::check($req->password_lama, Auth::user()->password)){
    		Auth::user()->update([
    			'password' => bcrypt($req->password),
    			'ganti_pass' => 1
    		]);
    		return redirect('/admin-password/reset')->with('success', 'Password berhasil diganti');
    	}

    	return redirect()->back()->with('error', 'Password lama Anda salah');
    }

    public function buatPassword() {
        $data = User::all();
        foreach($data as $row){
            User::find($row->id)->update([
                'password' => bcrypt($row->nim)
            ]);
        }
        return 1;
    }

    public function exportExcel(Request $req) {

        $data = User::with([
            'prestasi',
            'organisasi',
            'prodi',
            'mhsangkatan',
            'logs' => function($query){
                $query->where('tipe', 1)->orderBy('id', 'desc');
            }
        ]);

        if($req->has('lengkap')){
            $data->where('lengkap', $req->lengkap);
        } 

        $data = $data->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $mahasiswa = []; 

        // Define the Excel spreadsheet headers
        $mahasiswa[] = [
            'NIM', 
            'Nama',
            'Angkatan',
            'Program studi', 
            'Jumlah Prestasi', 
            'Jumlah Pengalaman Organisasi', 
            'Terakhir login'
        ];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($data as $row) {
            $login = "Tidak ada";
            if(count($row->logs) > 0){
                $login = $row->logs[0]->created_at->format('l, d F Y - H:i');
            }
            $prestasi = (count($row->prestasi))? count($row->prestasi) : 'Tidak ada';
            $organisasi = (count($row->organisasi))? count($row->organisasi) : 'Tidak ada';
            $mahasiswa[] = [
                $row->nim,
                $row->nama,
                $row->mhsangkatan->tahun,
                $row->prodi->nama,
                $prestasi,
                $organisasi,
                $login
            ];
        }

        // Generate and return the spreadsheet
        Excel::create('peserta', function($excel) use ($mahasiswa) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Peserta Student Day');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($mahasiswa) {
                $sheet->fromArray($mahasiswa, null, 'A1', false, false);
            });

        })->download('xlsx');
    }


}
