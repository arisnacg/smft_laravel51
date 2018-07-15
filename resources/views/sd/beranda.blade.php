@extends('layouts.beranda-layout')

@section('active1')
	active
@endsection

@section('content')
	<h2 class="mb-4"><i class="fa fa-home"></i> Beranda</h2>
    @if(session('success'))
    	<div class="alert alert-success">
	        {{ session('success') }}
	    </div>
	@endif
	<div class="card mb-4">
		<div class="card-body">
			<h4><i class="fa fa-bullhorn"></i> Pengumuman</h4>
			@if (count($data))
				@foreach ($data as $pengumuman)
					<div class="card my-4 box-shadow wow fadeInUp" style="border-radius: 0px">
						<div class="card-body">
							<h5 class="card-title text-body" style="color: #333; font-weight: 500; font-size: 24px; margin-bottom: 20px">{{ $pengumuman->judul }}</h5>
							<div class="media mb-3">
								<img class="mr-3" src="/thumbnail/{{ $pengumuman->gambar }}" height="auto" width="30%" alt="">
								<div class="media-body">
									<p class="card-text text-justify">
										{{ str_limit($pengumuman->konten, 400) }}
									</p>
								</div>
							</div>
							
							
							<div class="d-flex justify-content-between align-items-center">
								<a target="_blank" href="{{ route('sd-pengumuman.show', $pengumuman->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 0px">Lihat</a>
								<small class="text-muted">{{ date('d-m-Y', strtotime($pengumuman->created_at)) }}</small>
							</div>
						</div>
					</div>
				@endforeach
				<a target="_blank" href="{{ route('sd-pengumuman.index') }}" style="border-radius:50px;" class="btn btn-secondary">Lebih banyak..</a>
			@else
				<p class="text-center">Tidak ada pengumuman</p>
			@endif
		</div>
	</div>
@endsection