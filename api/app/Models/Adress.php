<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'tipo_endereco',
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'complemento',
        'numero',
        'user_id',
        'estado'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tipo_endereco' => 'string',
    ];

    public function getTipoEnderecoAttribute($value)
    {
        return $value == 0 ? 'Residencial' : 'Comercial';
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
