<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;
    protected $table = 'programa';
    public $timestamps = false;

    public function treneriai()
    {
        return $this->belongsToMany(Treneris::class);
    }

    public function atsiliepimai()
    {
        return $this->hasMany(Atsiliepimas::class);
    }
}
