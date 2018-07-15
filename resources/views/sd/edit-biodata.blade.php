@extends('layouts.beranda-layout')

@section('active2')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-user"></i> Edit Biodata</h2>  
    @if (Session::has('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle"></i> {{ Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <div class="col-md-8">
                <form action="{{ route('beranda-sd.update', Auth::user()->id) }}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><label for="nim">NIM</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nim" id="nim" value="{{ $data->nim }}" disabled required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama">Nama</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama" id="nama" value="{{ $data->nama }}" required>
                                    @if($errors->has('nama'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('nama') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama_panggilan">Nama Panggilan</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama_panggilan" id="nama_panggilan" value="{{ $data->nama_panggilan }}" required>
                                    @if($errors->has('nama_panggilan'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('nama_panggilan') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="program_studi">Program Studi</label></td>
                                <td>
                                    <select name="program_studi" id="program_studi" class="custom-select" required>
                                        @foreach ($program_studi as $prodi)
                                        <option @if($data->program_studi == $prodi->id) selected @endif value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('program_studi'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('program_studi') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="jenis_kelamin">Jenis Kelamin</label></td required>
                                <td>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select">
                                        @foreach ($jenis_kelamins as $jenis_kelamin)
                                            <option @if($data->jenis_kelamin == $jenis_kelamin->id) selected @endif value="{{ $jenis_kelamin->id }}">{{ $jenis_kelamin->nama }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('jenis_kelamin'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="agama">Agama</label></td>
                                <td>
                                    <select name="agama" id="agama" class="custom-select">
                                        <option>- Pilih agama -</option>
                                        @foreach ($agamas as $agama)
                                            <option @if($data->agama == $agama->id) selected @endif value="{{ $agama->id }}">{{ $agama->nama }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('agama'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('agama') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="gol_darah">Golongan Darah</label></td>
                                <td>
                                    <select name="gol_darah" id="gol_darah" class="custom-select" required>
                                        @if (intval($data->gol_darah) == 0)
                                            <option value="0" selected>- Pilih golongan darah -</option>
                                            @foreach ($gol_darahs as $gol_darah)
                                                <option value="{{ $gol_darah->id }}">{{ $gol_darah->nama }}</optionendif>
                                            @endforeach
                                        @else
                                            @foreach ($gol_darahs as $gol_darah)
                                                <option @if($data->gol_darah == $gol_darah->id) selected @endif value="{{ $gol_darah->id }}">{{ $gol_darah->nama }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('gol_darah'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('gol_darah') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="tempat_lahir">Tempat Lahir</label></td>
                                <td>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $data->tempat_lahir }}" required>
                                    @if($errors->has('tempat_lahir'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="tanggal_lahir">Tanggal Lahir</label></td>
                                <td>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $data->tanggal_lahir }}" required>
                                    @if($errors->has('tanggal_lahir'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="alamat">Alamat</label></td>
                                <td>
                                    <textarea class="form-control" name="alamat" id="alamat" rows="3" required>{{ $data->alamat }}</textarea>
                                    @if($errors->has('alamat'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="alamat_sekarang">Alamat Sekarang</label></td>
                                <td>
                                    <textarea class="form-control" name="alamat_sekarang" id="alamat_sekarang" rows="3" required>{{ $data->alamat_sekarang }}</textarea>
                                    @if($errors->has('alamat'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="no_telepon">Nomor Telepon</label></td>
                                <td>
                                    <input type="number" class="form-control" name="no_telepon" id="no_telepon" value="{{ $data->no_telepon }}" required>
                                    @if($errors->has('tanggal_lahir'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="no_hp">Nomor Ponsel</label></td>
                                <td>
                                    <input type="number" class="form-control" name="no_hp" id="no_hp" value="{{ $data->no_hp }}" required>
                                    @if($errors->has('no_hp'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('no_hp') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="email">Email</label></td>
                                <td>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ $data->email }}" required>
                                    @if($errors->has('email'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="asal_sekolah">Asal Sekolah</label></td>
                                <td>
                                    <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah" value="{{ $data->asal_sekolah }}" required>
                                    @if($errors->has('asal_sekolah'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('asal_sekolah') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="asalan_kuliah">Alasan Kuliah</label></td>
                                <td>
                                    <textarea name="alasan_kuliah" id="alasan_kuliah" class="form-control" rows="3" placeholder='Ketikkan alasan kuliah di Fakultas Teknik'>{{ $data->alasan_kuliah }}</textarea>
                                    @if($errors->has('alasan_kuliah'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('alasan_kuliah') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="hobi">Hobi</label></td>
                                <td>
                                    <textarea name="hobi" id="hobi" class="form-control" rows="3" placeholder="Ketikkan hobi Anda">{{ $data->hobi }}</textarea>
                                    @if($errors->has('hobi'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('hobi') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="cita_cita">Cita-cita</label></td>
                                <td>
                                    <input type="text" class="form-control" name="cita_cita" id="cita_cita" value="{{ $data->cita_cita }}" required>
                                    @if($errors->has('cita_cita'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('cita_cita') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="idola">Idola</label></td>
                                <td>
                                    <input type="text" class="form-control" name="idola" id="idola" value="{{ $data->idola }}" required>
                                    @if($errors->has('idola'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('idola') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="moto">Moto</label></td>
                                <td>
                                    <input type="text" class="form-control" name="moto" id="moto" value="{{ $data->moto }}" required>
                                    @if($errors->has('moto'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('moto') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="jumlah_saudara">Jumlah Saudara</label></td>
                                <td>
                                    <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudara" value="{{ $data->jumlah_saudara }}" required>
                                    @if($errors->has('jumlah_saudara'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('jumlah_saudara') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama_ayah">Nama Ayah</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" value="{{ $data->nama_ayah }}" required>
                                    @if($errors->has('nama_ayah'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('nama_ayah') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama_ibu">Nama Ibu</label></td>
                                <td>
                                    <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" value="{{ $data->nama_ibu }}" required>
                                    @if($errors->has('nama_ibu'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('nama_ibu') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="vegetarian">Vegetarian</label></td>
                                <td>
                                    <select class="form-control" name="vegetarian" id="vegetarian" required>
                                        @if ($data->vegetarian == '1')
                                            <option value="1" selected>Ya</option>
                                            <option value="2">Tidak</option>
                                        @elseif ($data->vegetarian == '2')
                                            <option value="1">Ya</option>
                                            <option value="2" selected>Tidak</option>
                                        @else
                                            <option>- Pilih -</option>
                                            <option value="1">Ya</option>
                                            <option value="2">Tidak</option>
                                        @endif
                                    </select>
                                    @if($errors->has('vegetarian'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('vegetarian') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="penyakit_khusus">Penyakit khusus</label></td>
                                <td>
                                    <textarea class="form-control" name="penyakit_khusus" id="penyakit_khusus" rows="3" placeholder='Ketikkan "Tidak Ada" Jika tidak memiliki penyakit khsusus. Jika ada sebutkan.' required>{{ $data->penyakit_khusus }}</textarea>
                                    @if($errors->has('penyakit_khusus'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="mahasiswa_baru">Mahasiswa baru</label></td>
                                <td> 
                                    <select name="mahasiswa_baru" id="mahasiswa_baru" class="custom-select" required>
                                        @if($data->mahasiswa_baru == '1')
                                            <option value="1" selected>Ya</option>
                                            <option value="2">Tidak</option>
                                        @elseif($data->mahasiswa_baru == '2')
                                            <option value="1">Ya</option>   
                                            <option value="2" selected>Tidak</option>
                                        @else
                                            <option>- Pilih -</option>
                                            <option value="1">Ya</option>   
                                            <option value="2">Tidak</option>
                                        @endif
                                    </select>
                                    @if($errors->has('mahasiswa_baru'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('mahasiswa_baru') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><label for="angkatan">Angkatan</label></td>
                                <td>
                                    <select name="angkatan" id="angkatan" class="form-control" required>
                                        <option>- Pilih angkatan -</option>
                                        @foreach ($angkatans as $angkatan)
                                            <option @if($data->angkatan == $angkatan->id) selected @endif value="{{ $angkatan->id }}">{{ $angkatan->tahun }}</option>                                            
                                        @endforeach
                                    </select>
                                    @if($errors->has('angkatan'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('angkatan') }}</strong>
                                        </span> 
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('beranda-sd.biodata') }}" class="btn btn-secondary"><i class="fa fa-times"></i> Batalkan perubahan</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection