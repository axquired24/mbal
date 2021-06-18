<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','file', 'thn_dokumen'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
