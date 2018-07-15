@extends('layouts.beranda-layout')

@section('active2')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Biodata</h2>  
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Auth::user()->lengkap != '1')
        <div class="alert alert-warning">
            <i class="fa fa-exclamation-circle"></i> Biodata Anda belum lengkap. Lengkapi biodata untuk dapat mencetak berkas Student Day.
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-primary btn-sm mb-3"><i class="fa fa-edit"></i>Ubah biodata</a>
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><label for="nim">NIM</label></td>
                            <td>: {{ $data->nim }}</td>
                        </tr>
                        <tr>
                            <td><label for="nama">Nama</label></td>
                            <td>: {{ $data->nama }}</td>
                        </tr>
                        <tr>
                            <td><label for="nama_panggilan">Nama panggilan</label></td>
                            @if ($data->nama_panggilan == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->nama_panggilan }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="program_studi">Program Studi</label></td>
                            @if ($data->prodi)
                                <td>: {{ $data->prodi }}</td>
                            @else
                                <td>: -</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="jenis_kelamin">Jenis Kelamin</label></td>
                            @if ($data->jk)
                                <td>: {{ $data->jk }}</td>
                            @else
                                <td>: -</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="agama">Agama</label></td>
                            @if ($data->agama)
                                <td>: {{ $data->agama_ }}</td>
                            @else
                                <td>: -</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="gol_darah">Golongan Darah</label></td>
                            @if ($data->goldar)
                                <td>: {{ $data->goldar }}</td>
                            @else
                                <td>: -</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="tempat_lahir">Tempat Lahir</label></td>
                            @if ($data->tempat_lahir == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->tempat_lahir }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="tanggal_lahir">Tanggal Lahir</label></td>
                            @if ($data->tanggal_lahir == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->tanggal_lahir }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="alamat">Alamat</label></td>
                            @if ($data->alamat == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->alamat }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="alamat_sekarang">Alamat Sekarang</label></td>
                            @if ($data->alamat_sekarang == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->alamat_sekarang }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="no_telepon">Nomor Telepon</label></td>
                            @if ($data->no_telepon == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->no_telepon }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="no_hp">No Ponsel</label></td>
                            @if ($data->no_hp == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->no_hp }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            @if ($data->email == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->email }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="asal_sekolah">Asal Sekolah</label></td>
                            @if ($data->asal_sekolah == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->asal_sekolah }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="alasan_kuliah">Alasan kuliah</label></td>
                            @if ($data->alasan_kuliah)
                                <td>: {{ $data->alasan_kuliah }}</td>
                            @else
                                <td>: -</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="hobi">Hobi</label></td>
                            @if ($data->hobi == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->hobi }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="cita_cita">Cita-cita</label></td>
                            @if ($data->cita_cita == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->cita_cita }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="idola">Idola</label></td>
                            @if ($data->idola == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->idola }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="moto">Moto</label></td>
                            @if ($data->moto == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->moto }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="jumlah_saudara">Jumlah Saudara</label></td>
                            @if (intval($data->jumlah_saudara) < 0)
                                <td>: -</td
                            @else
                                <td>: {{ $data->jumlah_saudara }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="nama_ayah">Nama Ayah</label></td>
                            @if ($data->nama_ayah == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->nama_ayah }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="nama_ibu">Nama Ibu</label></td>
                            @if ($data->nama_ibu == NULL)
                                <td>: -</td>
                            @else
                                <td>: {{ $data->nama_ibu }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="vegetarian">Vegetarian</label></td>
                            @if ($data->vegetarian)
                                @if ($data->vegetarian == 1)
                                    <td>: Ya</td>
                                @else
                                    <td>: Tidak</td>
                                @endif
                            @else
                                <td>: Belum ditentukan</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="penyakit_khusus">Penyakit Khusus</label></td>
                            @if ($data->penyakit_khusus)
                                <td>: {{ $data->penyakit_khusus }}</td>
                            @else
                                <td>: Belum ditentukan</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="mahasiswa_baru">Mahasiswa Baru</label></td>
                            @if ($data->mahasiswa_baru)
                                @if ($data->mahasiswa_baru == '1')
                                    <td>: Ya</td>
                                @else
                                    <td>: Tidak</td>
                                @endif
                            @else
                                <td>: Belum ditentukan</td>
                            @endif
                        </tr>
                        <tr>
                            <td><label for="angkatan">Angkatan</label></td>
                            @if ($data->angkatan)
                                <td>: {{ $data->tahun }}</td>
                            @else
                                <td>: Belum ditentukan</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection