@extends('layouts.beranda-layout')

@section('active4')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-trophy"></i> Prestasi Mahasiswa</h2>  
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <a href="#" data-toggle="modal" data-target="#modalTambah" class="btn btn-primary mb-3"><i class="fa fa-plus-circle mr-1"></i>Tambah Prestasi</a>
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Prestasi</th>
                            <th scope="col">Tingkat</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($prestasi) > 0)
                        @foreach($prestasi as $i => $row)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->tingkat }}</td>
                            <td>{{ $row->tahun }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete">
                                    <i class="fa fa-trash"></i>
                                    Hapus
                                </button>
                                <!-- Modal Delete Prestasi -->
                                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin menghapus prestasi <b>{{$row->nama}}</b>?
                                            </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                                <form method="POST" action="/prestasi/{{ $row->id }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa fa-trash"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <form method="POST" action="/prestasi/{{ $row->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa fa-trash"  style="margin-right: 10px"></i>
                                        Hapus
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                <p style="text-align: center;">Tidak ada prestasi</p>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add Prestasi -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-body" id="exampleModalCenterTitle"><i class="fa fa-trophy" style="margin-right: 10px"></i> Prestasi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/prestasi">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label class="label-control">Nama Prestasi</label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Lomba Catur">
                        @if($errors->has('nama'))
                            <small class="text-danger">{{ $errors->first('nama') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="label-control">Tingkat</label>
                        <input type="text" name="tingkat" class="form-control" placeholder="Contoh: Provinsi">
                        @if($errors->has('tingkat'))
                            <small class="text-danger">{{ $errors->first('tingkat') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="label-control">Tahun</label>
                        <input type="text" name="tahun" class="form-control" placeholder="Contoh: 2018">
                        @if($errors->has('tahun'))
                            <small class="text-danger">{{ $errors->first('tahun') }}</small>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save" style="margin-right: 10px"></i>
                        Simpan Prestasi
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- End Modal -->
@endsection