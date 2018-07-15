<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
    	'id',
        'mahasiswa_id',
        //ket tipe log
        // 1 -> login
        // 2 -> logout
        // 3 -> update biodata
        // 4 -> tambah prestasi 
        // 5 -> hapus prestasi
        // 6 -> tambah organisasi
        // 7 -> hapus organisasi
        // 8 -> ganti password
        'tipe',
        'konten'
    ];
}