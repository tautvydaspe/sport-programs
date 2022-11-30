<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atsiliepimas extends Model
{
    use HasFactory;
    protected $table = 'atsiliepimas';
    public $timestamps = false;

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }
}
