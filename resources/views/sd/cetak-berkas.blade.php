@extends('layouts.beranda-layout')

@section('active3')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-print"></i> Cetak Berkas</h2>
    @if ($data->lengkap == 1)
        <div class="alert alert-success">
            <i class="fa fa-check-circle"></i> Biodata sudah lengkap. Berkas siap untuk dicetak.<br>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Berkas</th>
                            <th>Ukuran Kertas</th>
                            <th>Link Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Form Verifikasi</td>
                            <td>A4</td>
                            <td>
                                <a target="_blank" class="btn btn-success" href="{{ route('beranda-sd.biodata-pdf') }}"><span class="fa fa-download"></span> Download Berkas</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Name Tag</td>
                            <td>A4</td>
                            <td>
                                <a target="_blank" class="btn btn-success" href="{{ route('beranda-sd.name-tag') }}"><span class="fa fa-download"></span> Download Berkas</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Kartu Evaluasi</td>
                            <td>A4</td>
                            <td>
                                <a target="_blank" class="btn btn-success" href="{{ route('beranda-sd.evaluasi-pdf') }}"><span class="fa fa-download"></span> Download Berkas</a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Buku Panduan Student Day</td>
                            <td>A4 Format Buku Bolak Balik (A4 dibagi 2)</td>
                            <td>
                                <a target="_blank" class="btn btn-success" href="/buku-panduan"><span class="fa fa-download"></span> Download Berkas</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{-- <div class="row justify-content-between">
                    <div class="col-md-4">
                        <a target="_blank"href="{{ route('beranda-sd.biodata-pdf') }}"><i class="fa fa-user"></i> Cetak Biodata</a>
                    </div>
                    <div class="col-md-4">
                        <a target="_blank" href="{{ route('beranda-sd.name-tag') }}"><i class="fa fa-print"></i> Cetak Name Tag</a>
                    </div>
                    <div class="col-md-4">
                        <a target="_blank" href="{{ route('beranda-sd.evaluasi-pdf') }}"><i class="fa fa-print"></i> Cetak Kartu Evaluasi</a>
                    </div>
                </div> --}}
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            <i class="fa fa-exclamation-circle"></i> Biodata Anda belum lengkap. Lengkapi biodata untuk dapat mencetak berkas Student Day. <br>
            <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-primary mt-3"><i class="fa fa-edit"></i> Lengkapi biodata</a>
        </div>
    @endif
        
    
@endsection