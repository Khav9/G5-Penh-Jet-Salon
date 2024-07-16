<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id', 'owner_id', 'text','images'
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }
}
