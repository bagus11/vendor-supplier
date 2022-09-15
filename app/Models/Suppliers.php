<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Suppliers extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'suppliers';

    protected $guard = [];
}
