<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKantor extends Model
{
    use HasFactory;
    protected $table = 'master_kantors';
    protected $guarded = ['email'];
}
