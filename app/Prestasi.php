<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $fillable = [
    	'mahasiswa_id',
    	'nama',
    	'tingkat',
    	'tahun'
    ];

    public function mahasiswa(){
    	$this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
