<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villages extends Model
{
    use HasFactory;
    protected $table = 'tbl_kelurahan';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'kecamatan_id',
        'kelurahan',  
        'kd_pos',  
    ];
}
