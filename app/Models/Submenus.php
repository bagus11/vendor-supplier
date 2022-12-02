<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenus extends Model
{
    use HasFactory;
    protected $table = 'submenuses';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'name',
        'description',
        'status',
        'id_menus',
        'link',
        'permission_name',
    ];
}
