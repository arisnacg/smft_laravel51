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
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <a target="_blank"href="{{ route('beranda-sd.biodata-pdf') }}"><i class="fa fa-user"></i> Cetak Biodata</a>
                    </div>
                    <div class="col-md-4">
                        <a target="_blank" href="{{ route('beranda-sd.name-tag') }}"><i class="fa fa-print"></i> Cetak Name Tag</a>
                    </div>
                    <div class="col-md-4">
                        <a target="_blank" href="{{ route('beranda-sd.evaluasi-pdf') }}"><i class="fa fa-print"></i> Cetak Kartu Evaluasi</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            <i class="fa fa-exclamation-circle"></i> Biodata Anda belum lengkap. Lengkapi biodata untuk dapat mencetak berkas Student Day. <br>
            <a href="/beranda-sd/{{ Auth::user()->id }}/edit" class="btn btn-primary mt-3"><i class="fa fa-edit"></i> Lengkapi biodata</a>
        </div>
    @endif
        
    
@endsection