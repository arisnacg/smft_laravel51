@extends('layouts.admin-layout')

@section('active2')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Mahasiswa</h2>  
    <div class="alert alert-warning" role="alert">
        <i class="fa fa-info-circle"></i> Klik pada baris data untuk melihat detail
    </div>
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <a href="{{ route('admin.mahasiswa-create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus-circle mr-1"></i>Tambah mahasiswa</a>
            <a
            @if(isset($filter['lengkap']))
                href="/export-excel?lengkap={{$filter['lengkap']}}"
            @else
                href="/export-excel"
            @endif
             class="btn btn-success mb-3"><i class="fa fa-file mr-1"></i>Export Excel</a>
            <hr>
            <form action="/admin-mahasiswa" action="GET">
                <div class="form-group row">
                    <div class="col-md-3 col-sm-12">
                        <select name="lengkap" class="form-control">
                            <option value="">Semua</option>
                            <?php
                                $arr = ['Belum Verifikasi', 'Sudah Verifikasi'];
                            ?>
                            @foreach($arr as $i => $r)
                                <option value="{{ $i }}"
                                    @if(isset($filter['lengkap']))
                                        @if($i == $filter['lengkap']) selected @endif
                                    @endif
                                >
                                    {{ $r }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <button type="submit" class="btn btn-primary"><span class="fa fa-filter"></span> Filter</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Pengalaman</th>
                            <th>Status Verifikasi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data))
                            @foreach ($data as  $i => $mahasiswa)
                                <tr>
                                    <th
                                        data-toggle="modal" data-target="#mahasiswa" 
                                        data-nim=": {{ $mahasiswa->nim }}" 
                                        data-nama=": {{ $mahasiswa->nama }}" 
                                        data-nama-panggilan=": {{ $mahasiswa->nama_panggilan }}"
                                        data-prodi=": {{ $mahasiswa->prodi->nama }}" 
                                        data-jenis-kelamin=": {{ $mahasiswa->jk }}"
                                        data-agama=": 
                                        @if($mahasiswa->agama == '1')
                                            Hindu
                                        @elseif($mahasiswa->agama == '2')
                                            Islam
                                        @elseif($mahasiswa->agama == '3')
                                            Budha
                                        @elseif($mahasiswa->agama == '4')
                                            Kristen Protestan
                                        @elseif($mahasiswa->agama == '5')
                                            Kristen Katolik
                                        @elseif($mahasiswa->agama == '6')
                                            Konghucu
                                        @endif
                                        "
                                        data-gol-darah=": {{ $mahasiswa->goldar }}"
                                        data-tempat-lahir=": {{ $mahasiswa->tempat_lahir }}"
                                        data-tanggal-lahir=": {{ $mahasiswa->tanggal_lahir }}"
                                        data-alamat=": {{ $mahasiswa->alamat }}"
                                        data-alamat-sekarang=": {{ $mahasiswa->alamat_sekarang }}"
                                        data-no-telepon=": {{ $mahasiswa->no_telepon }}"
                                        data-no-hp=": {{ $mahasiswa->no_hp }}"
                                        data-email=": {{ $mahasiswa->email }}"
                                        data-asal-sekolah=": {{ $mahasiswa->asal_sekolah }}"
                                        data-alasan-kuliah=": {{ $mahasiswa->alasan_kuliah }}"
                                        data-hobi=": {{ $mahasiswa->hobi }}"
                                        data-cita-cita=": {{ $mahasiswa->cita_cita }}"
                                        data-idola=": {{ $mahasiswa->idola }}"
                                        data-moto=": {{ $mahasiswa->moto }}"
                                        data-jumlah-saudara=": {{ $mahasiswa->jumlah_saudara }}"
                                        data-nama-ayah=": {{ $mahasiswa->nama_ayah }}" }}
                                        data-nama-ibu=": {{ $mahasiswa->nama_ibu }}"
                                        data-vegetarian=":
                                        @if($mahasiswa->vegetarian == '1')
                                           Ya
                                        @elseif($mahasiswa->vegetarian == '2')
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-penyakit-khusus=": {{ $mahasiswa->penyakit_khusus }}"
                                        data-mahasiswa-baru=": 
                                        @if($mahasiswa->mahasiswa_baru == '1')
                                            Ya
                                        @elseif($mahasiswa->mahasiswa_baru == '2')
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-angkatan=": {{ $mahasiswa->mhsangkatan->tahun }}"
                                        
                                        style="cursor:pointer"
                                    >{{ $i+1 }}
                                    </th>
                                    <td
                                        data-toggle="modal" data-target="#mahasiswa" 
                                        data-nim=": {{ $mahasiswa->nim }}" 
                                        data-nama=": {{ $mahasiswa->nama }}" 
                                        data-nama-panggilan=": {{ $mahasiswa->nama_panggilan }}"
                                        data-prodi=": {{ $mahasiswa->prodi->nama }}" 
                                        data-jenis-kelamin=": {{ $mahasiswa->jk }}"
                                        data-agama=": 
                                        @if($mahasiswa->agama == '1')
                                            Hindu
                                        @elseif($mahasiswa->agama == '2')
                                            Islam
                                        @elseif($mahasiswa->agama == '3')
                                            Budha
                                        @elseif($mahasiswa->agama == '4')
                                            Kristen Protestan
                                        @elseif($mahasiswa->agama == '5')
                                            Kristen Katolik
                                        @elseif($mahasiswa->agama == '6')
                                            Konghucu
                                        @endif
                                        "
                                        data-gol-darah=": {{ $mahasiswa->goldar }}"
                                        data-tempat-lahir=": {{ $mahasiswa->tempat_lahir }}"
                                        data-tanggal-lahir=": {{ $mahasiswa->tanggal_lahir }}"
                                        data-alamat=": {{ $mahasiswa->alamat }}"
                                        data-alamat-sekarang=": {{ $mahasiswa->alamat_sekarang }}"
                                        data-no-telepon=": {{ $mahasiswa->no_telepon }}"
                                        data-no-hp=": {{ $mahasiswa->no_hp }}"
                                        data-email=": {{ $mahasiswa->email }}"
                                        data-asal-sekolah=": {{ $mahasiswa->asal_sekolah }}"
                                        data-alasan-kuliah=": {{ $mahasiswa->alasan_kuliah }}"
                                        data-hobi=": {{ $mahasiswa->hobi }}"
                                        data-cita-cita=": {{ $mahasiswa->cita_cita }}"
                                        data-idola=": {{ $mahasiswa->idola }}"
                                        data-moto=": {{ $mahasiswa->moto }}"
                                        data-jumlah-saudara=": {{ $mahasiswa->jumlah_saudara }}"
                                        data-nama-ayah=": {{ $mahasiswa->nama_ayah }}" }}
                                        data-nama-ibu=": {{ $mahasiswa->nama_ibu }}"
                                        data-vegetarian=":
                                        @if($mahasiswa->vegetarian == '1')
                                           Ya
                                        @elseif($mahasiswa->vegetarian == '2')
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-penyakit-khusus=": {{ $mahasiswa->penyakit_khusus }}"
                                        data-mahasiswa-baru=": 
                                        @if($mahasiswa->mahasiswa_baru == '1')
                                            Ya
                                        @elseif($mahasiswa->mahasiswa_baru == '2')
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-angkatan=": {{ $mahasiswa->mhsangkatan->tahun }}"
                                        
                                        style="cursor:pointer"
                                    >
                                        {{ $mahasiswa->nim }}
                                    </td>
                                    <td
                                        data-toggle="modal" data-target="#mahasiswa" 
                                        data-nim=": {{ $mahasiswa->nim }}" 
                                        data-nama=": {{ $mahasiswa->nama }}" 
                                        data-nama-panggilan=": {{ $mahasiswa->nama_panggilan }}"
                                        data-prodi=": {{ $mahasiswa->prodi->nama }}" 
                                        data-jenis-kelamin=": {{ $mahasiswa->jk }}"
                                        data-agama=": 
                                        @if($mahasiswa->agama == '1')
                                            Hindu
                                        @elseif($mahasiswa->agama == '2')
                                            Islam
                                        @elseif($mahasiswa->agama == '3')
                                            Budha
                                        @elseif($mahasiswa->agama == '4')
                                            Kristen Protestan
                                        @elseif($mahasiswa->agama == '5')
                                            Kristen Katolik
                                        @elseif($mahasiswa->agama == '6')
                                            Konghucu
                                        @endif
                                        "
                                        data-gol-darah=": {{ $mahasiswa->goldar }}"
                                        data-tempat-lahir=": {{ $mahasiswa->tempat_lahir }}"
                                        data-tanggal-lahir=": {{ $mahasiswa->tanggal_lahir }}"
                                        data-alamat=": {{ $mahasiswa->alamat }}"
                                        data-alamat-sekarang=": {{ $mahasiswa->alamat_sekarang }}"
                                        data-no-telepon=": {{ $mahasiswa->no_telepon }}"
                                        data-no-hp=": {{ $mahasiswa->no_hp }}"
                                        data-email=": {{ $mahasiswa->email }}"
                                        data-asal-sekolah=": {{ $mahasiswa->asal_sekolah }}"
                                        data-alasan-kuliah=": {{ $mahasiswa->alasan_kuliah }}"
                                        data-hobi=": {{ $mahasiswa->hobi }}"
                                        data-cita-cita=": {{ $mahasiswa->cita_cita }}"
                                        data-idola=": {{ $mahasiswa->idola }}"
                                        data-moto=": {{ $mahasiswa->moto }}"
                                        data-jumlah-saudara=": {{ $mahasiswa->jumlah_saudara }}"
                                        data-nama-ayah=": {{ $mahasiswa->nama_ayah }}" }}
                                        data-nama-ibu=": {{ $mahasiswa->nama_ibu }}"
                                        data-vegetarian=":
                                        @if($mahasiswa->vegetarian == '1')
                                           Ya
                                        @elseif($mahasiswa->vegetarian == '2')
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-penyakit-khusus=": {{ $mahasiswa->penyakit_khusus }}"
                                        data-mahasiswa-baru=": 
                                        @if($mahasiswa->mahasiswa_baru == '1')
                                            Ya
                                        @elseif($mahasiswa->mahasiswa_baru == '2')
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-angkatan=": {{ $mahasiswa->mhsangkatan->tahun }}"
                                        
                                        style="cursor:pointer"
                                    >
                                        {{ $mahasiswa->nama }}
                                    </td>
                                    <td
                                        data-toggle="modal" data-target="#mahasiswa" 
                                        data-nim=": {{ $mahasiswa->nim }}" 
                                        data-nama=": {{ $mahasiswa->nama }}" 
                                        data-nama-panggilan=": {{ $mahasiswa->nama_panggilan }}"
                                        data-prodi=": {{ $mahasiswa->prodi->nama }}" 
                                        data-jenis-kelamin=": {{ $mahasiswa->jk }}"
                                        data-agama=": 
                                        @if($mahasiswa->agama == '1')
                                            Hindu
                                        @elseif($mahasiswa->agama == '2')
                                            Islam
                                        @elseif($mahasiswa->agama == '3')
                                            Budha
                                        @elseif($mahasiswa->agama == '4')
                                            Kristen Protestan
                                        @elseif($mahasiswa->agama == '5')
                                            Kristen Katolik
                                        @elseif($mahasiswa->agama == '6')
                                            Konghucu
                                        @endif
                                        "
                                        data-gol-darah=": {{ $mahasiswa->goldar }}"
                                        data-tempat-lahir=": {{ $mahasiswa->tempat_lahir }}"
                                        data-tanggal-lahir=": {{ $mahasiswa->tanggal_lahir }}"
                                        data-alamat=": {{ $mahasiswa->alamat }}"
                                        data-alamat-sekarang=": {{ $mahasiswa->alamat_sekarang }}"
                                        data-no-telepon=": {{ $mahasiswa->no_telepon }}"
                                        data-no-hp=": {{ $mahasiswa->no_hp }}"
                                        data-email=": {{ $mahasiswa->email }}"
                                        data-asal-sekolah=": {{ $mahasiswa->asal_sekolah }}"
                                        data-alasan-kuliah=": {{ $mahasiswa->alasan_kuliah }}"
                                        data-hobi=": {{ $mahasiswa->hobi }}"
                                        data-cita-cita=": {{ $mahasiswa->cita_cita }}"
                                        data-idola=": {{ $mahasiswa->idola }}"
                                        data-moto=": {{ $mahasiswa->moto }}"
                                        data-jumlah-saudara=": {{ $mahasiswa->jumlah_saudara }}"
                                        data-nama-ayah=": {{ $mahasiswa->nama_ayah }}" }}
                                        data-nama-ibu=": {{ $mahasiswa->nama_ibu }}"
                                        data-vegetarian=":
                                        @if($mahasiswa->vegetarian == '1')
                                           Ya
                                        @elseif($mahasiswa->vegetarian == '2')
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-penyakit-khusus=": {{ $mahasiswa->penyakit_khusus }}"
                                        data-mahasiswa-baru=": 
                                        @if($mahasiswa->mahasiswa_baru == '1')
                                            Ya
                                        @elseif($mahasiswa->mahasiswa_baru == '2')
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-angkatan=": {{ $mahasiswa->mhsangkatan->tahun }}"
                                        
                                        style="cursor:pointer"
                                    >
                                        {{ $mahasiswa->prodi->nama }}
                                    </td>
                                    <td>
                                        <a href="/prestasi/{{ $mahasiswa->id }}" class="btn btn-success btn-sm" style="margin-bottom: 5px"><i class="fa fa-trophy"></i> Prestasi</a>
                                        <a href="/organisasi/{{ $mahasiswa->id }}" class="btn btn-success btn-sm"><i class="fa fa-building"></i> Organisasi</a>
                                    </td>
                                    <td
                                        data-toggle="modal" data-target="#mahasiswa" 
                                        data-nim=": {{ $mahasiswa->nim }}" 
                                        data-nama=": {{ $mahasiswa->nama }}" 
                                        data-nama-panggilan=": {{ $mahasiswa->nama_panggilan }}"
                                        data-prodi=": {{ $mahasiswa->prodi->nama }}" 
                                        data-jenis-kelamin=": {{ $mahasiswa->jk }}"
                                        data-agama=": 
                                        @if($mahasiswa->agama == '1')
                                            Hindu
                                        @elseif($mahasiswa->agama == '2')
                                            Islam
                                        @elseif($mahasiswa->agama == '3')
                                            Budha
                                        @elseif($mahasiswa->agama == '4')
                                            Kristen Protestan
                                        @elseif($mahasiswa->agama == '5')
                                            Kristen Katolik
                                        @elseif($mahasiswa->agama == '6')
                                            Konghucu
                                        @endif
                                        "
                                        data-gol-darah=": {{ $mahasiswa->goldar }}"
                                        data-tempat-lahir=": {{ $mahasiswa->tempat_lahir }}"
                                        data-tanggal-lahir=": {{ $mahasiswa->tanggal_lahir }}"
                                        data-alamat=": {{ $mahasiswa->alamat }}"
                                        data-alamat-sekarang=": {{ $mahasiswa->alamat_sekarang }}"
                                        data-no-telepon=": {{ $mahasiswa->no_telepon }}"
                                        data-no-hp=": {{ $mahasiswa->no_hp }}"
                                        data-email=": {{ $mahasiswa->email }}"
                                        data-asal-sekolah=": {{ $mahasiswa->asal_sekolah }}"
                                        data-alasan-kuliah=": {{ $mahasiswa->alasan_kuliah }}"
                                        data-hobi=": {{ $mahasiswa->hobi }}"
                                        data-cita-cita=": {{ $mahasiswa->cita_cita }}"
                                        data-idola=": {{ $mahasiswa->idola }}"
                                        data-moto=": {{ $mahasiswa->moto }}"
                                        data-jumlah-saudara=": {{ $mahasiswa->jumlah_saudara }}"
                                        data-nama-ayah=": {{ $mahasiswa->nama_ayah }}" }}
                                        data-nama-ibu=": {{ $mahasiswa->nama_ibu }}"
                                        data-vegetarian=":
                                        @if($mahasiswa->vegetarian == '1')
                                           Ya
                                        @elseif($mahasiswa->vegetarian == '2')
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-penyakit-khusus=": {{ $mahasiswa->penyakit_khusus }}"
                                        data-mahasiswa-baru=": 
                                        @if($mahasiswa->mahasiswa_baru == '1')
                                            Ya
                                        @elseif($mahasiswa->mahasiswa_baru == '2')
                                            Tidak
                                        @else
                                            Belum ditentukan
                                        @endif
                                        "
                                        data-angkatan=": {{ $mahasiswa->mhsangkatan->tahun }}"
                                        
                                        style="cursor:pointer"
                                    >
                                        @if($mahasiswa->lengkap)
                                            Sudah
                                        @else
                                            Belum
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Edit Buton -->
                                        <a style="margin-bottom: 3px; display: block;" href="/log/{{ $mahasiswa->id }}" class="btn btn-info btn-sm"><i class="fa fa-list"></i></a>
                                        <!-- Edit Buton -->
                                        <a style="margin-bottom: 3px; display: block;" href="{{ route('admin.mahasiswa-edit', $mahasiswa->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <!--Delete Button -->
                                        <button data-toggle="modal" data-target="#delete" class="btn btn-block btn-danger btn-sm"
                                        data-nim=": {{ $mahasiswa->nim }}" 
                                        data-nama=": {{ $mahasiswa->nama }}" 
                                        data-prodi=": {{ $mahasiswa->prodi }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash text-danger"></i> Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center">Apakah Anda yakin menghapus data berikut?</p> 
                                                        <div class="row justify-content-center">
                                                            <table class="table-borderless">
                                                                <tr>
                                                                    <td class="font-weight-bold" style="width: 50%;">NIM</td>
                                                                    <td id="nim"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">Nama</td>
                                                                    <td id="nama"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-weight-bold">Program Studi</td>
                                                                    <td id="prodi"></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                                                        <form action="{{ route('admin.mahasiswa-delete', $mahasiswa->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{method_field('DELETE')}}
                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Ya</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Delete Modal -->
                                    </td>
                                </tr>
                            @endforeach
                        @endif    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Show -->
    <div class="modal fade" id="mahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-body" id="exampleModalCenterTitle"><i class="fa fa-info-circle"></i> Info Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" class="form-group" method="get">
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>NIM</td>
                                    <td id="nim-show"></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td id="nama-show"></td>
                                </tr>
                                <tr>
                                    <td>Nama Panggilan</td>
                                    <td id="nama-panggilan-show"></td>
                                </tr>
                                <tr>
                                    <td>Program Studi</td>
                                    <td id="prodi-show"></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td id="jenis-kelamin-show"></td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                    <td id="agama-show"></td>
                                </tr>
                                <tr>
                                    <td>Gol. Darah</td>
                                    <td id="gol-darah-show"></td>
                                </tr>
                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td id="tempat-lahir-show"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td id="tanggal-lahir-show"></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td id="alamat-show"></td>
                                </tr>
                                <tr>
                                    <td>Alamat Sekarang</td>
                                    <td id="alamat-sekarang-show"></td>
                                </tr>
                                <tr>
                                    <td>No. Telepon</td>
                                    <td id="no-telepon-show"></td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td id="no-hp-show"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td id="email-show"></td>
                                </tr>
                                <tr>
                                    <td>Asal Sekolah</td>
                                    <td id="asal-sekolah-show"></td>
                                </tr>
                                <tr>
                                    <td>Alasan Kuliah</td>
                                    <td id="alasan-kuliah-show"></td>
                                </tr>
                                <tr>
                                    <td>Hobi</td>
                                    <td id="hobi-show"></td>
                                </tr>
                                <tr>
                                    <td>Cita-cita</td>
                                    <td id="cita-cita-show"></td>
                                </tr>
                                <tr>
                                    <td>Idola</td>
                                    <td id="idola-show"></td>
                                </tr>
                                <tr>
                                    <td>Moto</td>
                                    <td id="moto-show"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Saudara</td>
                                    <td id="jumlah-saudara-show"></td>
                                </tr>
                                <tr>
                                    <td>Nama Ayah</td>
                                    <td id="nama-ayah-show"></td>
                                </tr>
                                <tr>
                                    <td>Nama Ibu</td>
                                    <td id="nama-ibu-show"></td>
                                </tr>
                                <tr>
                                    <td>Vegetarian</td>
                                    <td id="vegetarian-show"></td>
                                </tr>
                                <tr>
                                    <td>Penyakit khusus</td>
                                    <td id="penyakit-khusus-show"></td>
                                </tr>
                                <tr>
                                    <td>Mahasiswa baru</td>
                                    <td id="mahasiswa-baru-show">: 
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Angkatan</td>
                                    <td id="angkatan-show"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Modal -->
@endsection

@section('custom_javascript')
    <script>
        $('#mahasiswa').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var nim = button.data('nim')
            var nama = button.data('nama')
            var nama_panggilan = button.data('nama-panggilan')
            var prodi = button.data('prodi')
            var jenis_kelamin = button.data('jenis-kelamin')
            var agama = button.data('agama')
            var gol_darah = button.data('gol-darah')
            var tempat_lahir = button.data('tempat-lahir')
            var tanggal_lahir = button.data('tanggal-lahir')
            var alamat = button.data('alamat')
            var alamat_sekarang = button.data('alamat-sekarang')
            var no_telepon = button.data('no-telepon')
            var no_hp = button.data('no-hp')
            var email = button.data('email')
            var asal_sekolah = button.data('asal-sekolah')
            var alasan_kuliah = button.data('alasan-kuliah')
            var hobi = button.data('hobi')
            var cita_cita = button.data('cita-cita')
            var idola = button.data('idola')
            var moto = button.data('moto')
            var jumlah_saudara = button.data('jumlah-saudara')
            var nama_ayah = button.data('nama-ayah')
            var nama_ibu = button.data('nama-ibu')
            var vegetarian = button.data('vegetarian')
            var penyakit_khusus = button.data('penyakit-khusus')
            var mahasiswa_baru = button.data('mahasiswa-baru')
            var angkatan = button.data('angkatan')
            var modal = $(this)
            modal.find('.modal-body #nim-show').text(nim)
            modal.find('.modal-body #nama-show').text(nama)
            modal.find('.modal-body #nama-panggilan-show').text(nama_panggilan)
            modal.find('.modal-body #prodi-show').text(prodi)
            modal.find('.modal-body #jenis-kelamin-show').text(jenis_kelamin)
            modal.find('.modal-body #agama-show').text(agama)
            modal.find('.modal-body #gol-darah-show').text(gol_darah)
            modal.find('.modal-body #tempat-lahir-show').text(tempat_lahir)
            modal.find('.modal-body #tanggal-lahir-show').text(tanggal_lahir)
            modal.find('.modal-body #alamat-show').text(alamat)
            modal.find('.modal-body #alamat-sekarang-show').text(alamat_sekarang)
            modal.find('.modal-body #no-telepon-show').text(no_telepon)
            modal.find('.modal-body #no-hp-show').text(no_hp)
            modal.find('.modal-body #email-show').text(email)
            modal.find('.modal-body #asal-sekolah-show').text(asal_sekolah)
            modal.find('.modal-body #alasan-kuliah-show').text(alasan_kuliah)
            modal.find('.modal-body #hobi-show').text(hobi)
            modal.find('.modal-body #cita-cita-show').text(cita_cita)
            modal.find('.modal-body #idola-show').text(idola)
            modal.find('.modal-body #moto-show').text(moto)
            modal.find('.modal-body #jumlah-saudara-show').text(jumlah_saudara)
            modal.find('.modal-body #nama-ayah-show').text(nama_ayah)
            modal.find('.modal-body #nama-ibu-show').text(nama_ibu)
            modal.find('.modal-body #vegetarian-show').text(vegetarian)
            modal.find('.modal-body #penyakit-khusus-show').text(penyakit_khusus)
            modal.find('.modal-body #mahasiswa-baru-show').text(mahasiswa_baru)
            modal.find('.modal-body #angkatan-show').text(angkatan)
        })
    </script>

    <script>
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var nim = button.data('nim') 
            var nama = button.data('nama')
            var prodi = button.data('prodi')
            var modal = $(this)
            modal.find('.modal-body #nim').text(nim)
            modal.find('.modal-body #nama').text(nama)
            modal.find('.modal-body #prodi').text(prodi)
        })
    </script>
@endsection

