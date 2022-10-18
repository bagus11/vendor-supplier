<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $table = 'tbl_kecamatan';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'kabkot_id',
        'kecamatan'
    ];
}
