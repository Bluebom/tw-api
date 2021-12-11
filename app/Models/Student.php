<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth',
        'gender',
        'classroom_id'
    ];

    // // Formato ao serializar os dados
    // protected $casts = [
    //     'birth' => 'date:d/m/Y',
    //     'created_at' => 'date:d/m/Y'
    // ];

    // // Mostrar dados
    // protected $visible = ['id','name', 'gender', 'birth', 'classroom_id', 'is_accepted'];

    // // // Esconder esse dados
    // // protected $hidden = ['created_at', 'updated_at'];

    // // permite a adicao durante a serializacao
    // protected $appends = ['is_accepted'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // public function getIsAcceptedAttribute()
    // {
    //     return $this->attributes['birth'] > '1998-01-01' ? 'aceito' : 'não foi aceito';
    // }
}
