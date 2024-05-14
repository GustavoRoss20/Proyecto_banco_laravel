<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'cat_servicios';

    protected $fillable = [
        'id',
        'nombre',
        'precio',        
    ];
}
