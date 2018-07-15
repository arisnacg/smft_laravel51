@extends('layouts.layout')

@section('title')
	Home
@endsection

@section('active_home')
  menu-active
@endsection

@section('content')
    <!--==========================
	Hero Section
	============================-->
	<section id="hero">
		<div class="hero-container">
			{{-- <h1>SMFT</h1>
			<h2 class="mb-0">Senat Mahasiswa Fakultas Teknik</h2>
			<h2>Universitas Udayana</h2> --}}
			<!-- <a href="#about" class="btn-get-started">Get Started</a> -->
		</div>
	</section><!-- #hero -->

	<main id="main">

		<!--==========================
		About Us Section
		============================-->
		<section id="about">
			<div class="container">
				<div class="row about-container">
					<div class="col-lg-6 content order-lg-1 order-2">
						<h2 class="title">Tentang SMFT</h2>
						<p class="wow fadeInUp">
						Fakultas Teknik Universitas Udayana secara resmi berdiri pada tanggal 1 Oktober 1965 dengan Surat Keputusan Menteri PTIP No. 248/Sek/P.U/1965, tanggal 20 Oktober 1965, yang terdiri dari dua jurusan yaitu Jurusan Arsitektur dan Jurusan Seni Rupa. Sebagai latar belakang pendirian Fakultas Teknik Universitas Udayana, adalah dalam rangka pelestarian, pengembangan kebudayaan Daerah Bali pada khususnya dan kebudayaan nasional pada umumnya, terutama di dalam menghadapi pembangunan dan perkembangan kepariwisataan.
						</p>
					</div>
					<div class="col-lg-6 background order-lg-2 order-1 wow fadeInRight"></div>
				</div>
			</div>
		</section><!-- #about -->

	</main>
@endsection

