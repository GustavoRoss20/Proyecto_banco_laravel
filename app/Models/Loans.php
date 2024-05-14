<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;

    protected $table = 'prestamos';

    protected $fillable = [
        'id',
        'cliente_id',
        'referencia',        
        'total_prestado',
        'total_pagar',
        'cantidad_actual',
        'liquidado'
    ];
}
