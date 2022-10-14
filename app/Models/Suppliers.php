<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Suppliers extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'suppliers';

    protected $guarded = [];

    public function companyAttachment() {
        return $this->hasMany(CompanyAttachment::class, 'supplierId', 'id');
    }
    
    public function supplierAddress() {
        // return $this->hasMany(SupplierAddress::class, 'supplierId', 'id');
        return $this->hasOne(SupplierAddress::class, 'supplierId', 'userId');
    }
    
    public function supplierPic() {
        return $this->hasMany(Pic::class, 'supplierId', 'id');
    }
    
    public function supplierPayment() {
        return $this->hasMany(Payment::class, 'supplierId', 'id');
    }
}
