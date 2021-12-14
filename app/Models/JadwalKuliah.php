<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;
	
	protected $fillable = [
        'nama_pelajaran', 
        'jadwal_pelajaran', 
        'kode_pelajaran',
		'nama_dosen'
    ];
}
