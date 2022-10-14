<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierAddress extends Model
{
    use HasFactory;

    protected $table = 'supplier_addresses';
    protected $guarded = [];

    public function provinces() {
        return $this->belongsTo(Provinces::class, 'supplierProvince', 'id');
    }
    
    public function regencies() {
        return $this->belongsTo(Provinces::class, 'supplierCity', 'id');
    }
    
    public function districts() {
        return $this->belongsTo(Districts::class, 'supplierDistricts', 'id');
    }
    
    public function villages() {
        return $this->belongsTo(Villages::class, 'supplierVillage', 'id');
    }
    public function suppliers(){
        return $this->belongsTo(Suppliers::class, 'supplierId', 'userId');
    }

}
