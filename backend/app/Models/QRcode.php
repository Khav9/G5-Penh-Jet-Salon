<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRcode extends Model
{
    use HasFactory;

    protected $fillable = [
        'qr_code',
        'store_id',
    ];

    
    public function store()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }

}
