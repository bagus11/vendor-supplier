<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class CompanyAttachment extends Model
{
    use HasFactory,softDeletes;

    protected $table = 'company_attachments';

    protected $guarded = [];
}
