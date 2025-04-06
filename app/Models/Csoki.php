<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Csoki extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'csokik';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}