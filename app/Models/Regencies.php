<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regencies extends Model
{
    use HasFactory;
    protected $table = 'tbl_kabkot';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'provinsi_id',
        'kabupaten_kota'
    ];
}
